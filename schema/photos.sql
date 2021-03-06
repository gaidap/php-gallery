-- auto-generated definition
create table photos
(
    id             int auto_increment
        primary key,
    file_name      varchar(255)                             not null,
    title          varchar(255)                             not null,
    caption        varchar(255)                             null,
    alternate_text varchar(255) default ''                  not null,
    type           varchar(255)                             not null,
    size           int                                      not null,
    description    text                                     null,
    creation_date  timestamp    default current_timestamp() not null,
    constraint photos_file_name_uindex
        unique (file_name)
);

