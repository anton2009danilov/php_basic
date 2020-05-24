drop table if exists users_liked;
create table users_liked
(
    user_id int not null,
    item_id int not null,
    liked boolean,

    primary key (user_id, item_id),
    foreign key likes_user_id_fkey (user_id) references users (id),
    foreign key likes_item_id_fkey (item_id) references gallery (id)
);

INSERT INTO `users_liked` (`user_id`, `item_id`, `liked`) VALUES ('2', '1', '1'), ('2', '2', '0'), ('1', '1', '1');

INSERT INTO `gallery`(`size`, `name`, `description`, `item_name`, `price`)
           VALUES (119724, 'dragon.jpg', 'Сказочный дракончик. Любит летать и есть сладкое.', 'Дракончик', 300);