## Installation

Install Docker or any other docker compatible runtime of your liking, such as:

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Orbstack](https://orbstack.dev/)
- [Podman](https://podman.io/)

Run project setup script.

```bash
script/setup
```

Add the following environment variables to the `.env` file. We should have provided this values to you when we sent
you the instructions this project.

```dotenv
API_URL="<replace value here>"
UNRESTRICTED_API_KEY="<replace value here>"
CANDIDATE_API_KEY="<replace value here>"
```

Run the project setup command again.

```bash
script/setup
```

Finally, run this command to start the app server.

```bash
script/server
```

The app will available at [http://boldbrush-interview.test:8080](http://boldbrush-interview.test:8080)

Database access is available at `localhost:33060` using `root` as the user, and no password. Use your favorite database
client to connect to it.

## Recommendations

- Use Laravel's built in [Http client](https://laravel.com/docs/10.x/http-client) for making requests.