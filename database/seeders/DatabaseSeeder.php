<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Domain;
use App\Models\Mailbox;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Lottery;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->pullMailboxes();

        $domains = Mailbox::query()->select('domain')->distinct()->get();

        if ($domains->count() == 0) {
            throw new \Exception('No domains found to import');
        }

        $users = User::factory($domains->count())->create();

        $this->assignDomainsToUsers($domains, $users);

        // mark a few users as cancelled
        $users->random(rand(2, 6))->each(fn ($user) => $user->update(['status' => 'cancelled']));
    }

    private function pullMailboxes($page = 1): void
    {
        $apiKey = env('UNRESTRICTED_API_KEY');

        if (!$apiKey) {
            throw new \Exception('API key is missing. Please set `UNRESTRICTED_API_KEY` in your .env file.');
        }

        $response = Http::throw()
            ->withHeader('Authorization', "Bearer $apiKey")
            ->get('https://candidate-api.boldbrush.com/domains/seed', ['page' => $page])
            ->json();

        $records = [];

        foreach ($response['data'] as $domain) {
            foreach ($domain['boxes'] as $mailbox) {
                // omit a percentage of mailboxes
                Lottery::odds(chances: 8, outOf: 10)->winner(
                    fn () => $records[] = [
                        'domain' => $domain->domain,
                        'username' => $mailbox->username,
                        'status' => $mailbox->status,
                        'quota' => null,
                        'used' => null,
                        'created_at' => $mailbox->created_at,
                        'updated_at' => $mailbox->updated_at,
                        'deleted_at' => $mailbox->deleted_at,
                    ]
                )->choose();
            }
        }

        Mailbox::insert($records);

        if ($page < $response['last_page'])
        {
            $this->pullMailboxes($page + 1);
        }
    }

    private function assignDomainsToUsers(Collection $domains, Collection $users): void
    {
        $users->each(function ($user) use (&$domains) {
            if ($domains->count() == 0) {
                // skip if no domains left
                return;
            }

            $domainsAssignedToUser = rand(1, 3);

            $chunk = $domains->take($domainsAssignedToUser);

            $chunk->each(
                fn ($name) => $user->domains()->insert(['domain' => $name])
            );

            $domains = $domains->diff($chunk);
        });
    }
}
