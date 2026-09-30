FROM wordpress:latest

RUN a2enmod rewrite

COPY docker/apache/atlas.conf /etc/apache2/conf-available/atlas.conf

RUN a2enconf atlas
