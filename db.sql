create table categories
(
    id         bigint auto_increment,
    slug       varchar(255) not null,
    title      varchar(255) not null,
    created_at datetime default NOW(),
    constraint categories_pk
        primary key (id)
);

create unique index categories_slug_index
    on categories (slug);
create table books
(
    id          bigint auto_increment,
    title       varchar(300) not null,
    slug        varchar(400) not null,
    image       varchar(300) not null,
    author      varchar(255) not null,
    description text,
    pdf         varchar(255) null,
    created_at  datetime default NOW(),
    constraint books_pk
        primary key (id)
);

create unique index books_slug_index
    on books (slug);

create table book_category_pivot_table
(
    id          bigint auto_increment,
    category_id bigint not null,
    book_id     bigint not null,
    constraint book_category_pivot_table_pk
        primary key (id),
    constraint book_category_pivot_table_book__fk
        foreign key (book_id) references books (id)
            on delete cascade,
    constraint book_category_pivot_table_categories_id_fk
        foreign key (category_id) references categories (id)
            on delete cascade
);

create index book_category_pivot_table_book_id_category_id_index
    on book_category_pivot_table (book_id, category_id);

create table users
(
    id         bigint auto_increment,
    first_name varchar(200),
    last_name  varchar(200),
    email      varchar(225),
    password   varchar(255),
    created_at datetime default NOW(),
    constraint users_pk
        primary key (id)
);
create table user_reservations
(
    id          bigint auto_increment,
    user_id     bigint,
    book_id     bigint,
    created_at  datetime default NOW(),
    return_date date,
    confirmed   boolean  default false,
    constraint user_reservations_users_fk
        foreign key (user_id) references users (id)
            on delete cascade,
    constraint user_reservations_roles_fk
        foreign key (book_id) references books (id)
            on delete cascade,
    constraint user_reservations_pk
        primary key (id)
);

create index user_reservations_indexes on user_reservations (book_id, user_id);

create table roles
(
    id         bigint auto_increment,
    name       varchar(255),
    created_at datetime default NOW(),
    constraint roles_pk
        primary key (id)
);

create table user_roles
(
    id      bigint auto_increment,
    user_id bigint,
    role_id bigint,
    constraint user_roles_users_fk
        foreign key (user_id) references users (id)
            on delete cascade,
    constraint user_roles_roles_fk
        foreign key (role_id) references roles (id)
            on delete cascade,
    constraint user_roles_pk
        primary key (id)
);