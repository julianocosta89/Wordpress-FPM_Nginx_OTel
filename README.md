# Description

This sample is composed by Nginx, PHP-FPM and Jaeger.
Nginx and PHP-FPM are instrumented with OpenTelemetry and sending traces to Jaeger.

The app is exposed on port 8080, but that can be modified at [.env](.env).

## Dependencies

- Docker Compose `v2`+
- Docker version `23.0.3`+

## Usage

- Run the following command:

```bash
docker compose up
```

## Access your application

The PHP-FPM page is accessible at <http://localhost:8080>.

The JaegerUI is accessible at <http://localhost:16686>.
