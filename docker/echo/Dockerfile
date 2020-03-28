FROM node:lts-alpine

RUN apk add --update --no-cache bash \
RUN set -eux; \
    apk add --update --no-cache \
        sqlite \
        openssl \
        curl \
    ; \
    apk add --update --no-cache --virtual .build-deps \
        build-base \
    ; \
    yarn global add --prod --no-lockfile laravel-echo-server ; \
 apk del .build-deps ; \
    yarn cache clean ; \
    mkdir -p /app/database ;

ENTRYPOINT ["laravel-echo-server"]
CMD ["start"]