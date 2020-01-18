delete
from `books`
WHERE `id` > 0;
alter table books
    AUTO_INCREMENT = 1;
delete
from `categories`
WHERE `id` > 0;
alter table categories
    AUTO_INCREMENT = 1;
delete
from `book_category_pivot_table`
WHERE `id` > 0;
alter table book_category_pivot_table
    AUTO_INCREMENT = 1;
delete
from `categories`
WHERE `id` > 0;
alter table categories
    AUTO_INCREMENT = 1;
delete
from `roles`
WHERE `id` > 0;
alter table roles
    AUTO_INCREMENT = 1;
delete
from `user_reservations`
WHERE `id` > 0;
alter table user_reservations
    AUTO_INCREMENT = 1;
