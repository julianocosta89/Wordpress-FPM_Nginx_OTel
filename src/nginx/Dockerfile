ARG NGINX_VERSION=1.23.1
FROM nginx:${NGINX_VERSION} as base

FROM base as builder
RUN apt-get update ; apt-get install unzip
ADD https://github.com/open-telemetry/opentelemetry-cpp-contrib/releases/download/webserver%2Fv1.0.3/opentelemetry-webserver-sdk-x64-linux.tgz /opt
RUN cd /opt && tar zxvf opentelemetry-webserver-sdk-x64-linux.tgz

FROM base as runtime
COPY site.conf /etc/nginx/conf.d/default.conf
COPY --from=builder /opt/opentelemetry-webserver-sdk /opt/opentelemetry-webserver-sdk
RUN cd /opt/opentelemetry-webserver-sdk; ./install.sh
ENV LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/opt/opentelemetry-webserver-sdk/sdk_lib/lib
RUN echo "load_module /opt/opentelemetry-webserver-sdk/WebServerModule/Nginx/${NGINX_VERSION}/ngx_http_opentelemetry_module.so;\n$(cat /etc/nginx/nginx.conf)" > /etc/nginx/nginx.conf
COPY opentelemetry_module.conf /etc/nginx/conf.d
