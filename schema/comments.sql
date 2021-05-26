-- auto-generated definition
create table comments
(
    id       int auto_increment
        primary key,
    photo_id int          not null,
    author   varchar(255) not null,
    body     text         null,
    constraint comments_photos__fk
        foreign key (photo_id) references photos (id)
            on update cascade on delete cascade
);

create index comments_photo_id__index
    on comments (photo_id);

