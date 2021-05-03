-- auto-generated definition
create table photos
(
    id            int auto_increment
        primary key,
    file          varchar(255)                          not null,
    file_name     varchar(255)                          not null,
    title         varchar(255)                          not null,
    type          varchar(255)                          not null,
    size          int                                   not null,
    description   text                                  null,
    creation_date timestamp default current_timestamp() not null,
    constraint photos_file_path_uindex
        unique (file)
);

