FROM mysql:latest

RUN chown -R mysql:root /var/lib/mysql/

ENV MYSQL_DATABASE=musicin
ENV MYSQL_ALLOW_EMPTY_PASSWORD=true
#ADD data.sql /etc/mysql/data.sql

#RUN sed -i 's/MYSQL_DATABASE/'$MYSQL_DATABASE'/g' /etc/mysql/data.sql
#RUN cp /etc/mysql/data.sql /docker-entrypoint-initdb.d

EXPOSE 3306

