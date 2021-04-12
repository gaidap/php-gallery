-- auto-generated definition
create table users
(
    id            int auto_increment
        primary key,
    username      varchar(255)                          not null,
    password      varchar(255)                          not null,
    first_name    varchar(255)                          not null,
    last_name     varchar(255)                          not null,
    creation_date timestamp default current_timestamp() not null
);
