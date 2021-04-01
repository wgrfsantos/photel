
INSERT INTO `users` (`id_users`, `id_permission`, `email`, `password`, `name`, `admin`, `token`) VALUES
(1, 1, 'admin1@admin.com.br', 'e10adc3949ba59abbe56e057f20f883e', 'Admin1', 1, '3dfb54de3b6fbafb41b884445d5e08df'),
(2, 1, 'admin2@admin.com', 'd0f82e1046ccbd597c7f2a7bfba9e7dd', 'Admin2', 1, 'c0312ce739656110ddad5d6feab67cf6');

INSERT INTO `permission_groups` (`id_permission_groups`, `name`) VALUES
(1, 'Desenvolvedor'),
(2, 'Administrativo'),
(3, 'Gerência'),
(4, 'Funcionários');


INSERT INTO `permission_items` (`id_permission_items`, `name`, `slug`, `type`) VALUES
(1, 'Permissões', 'permissions_view', 1),
(2, 'Permissões', 'permissions_add', 2),
(3, 'Permissões', 'permissions_edit', 3),
(4, 'Permissões', 'permissions_del', 4),
(5, 'Usuários', 'users_view', 1),
(6, 'Usuários', 'users_add', 2),
(7, 'Usuários', 'users_edit', 3),
(8, 'Usuários', 'users_del', 4),
(9, 'Produtos', 'products_view', 1),
(10, 'Produtos', 'products_add', 2),
(11, 'Produtos', 'products_edit', 3),
(12, 'Produtos', 'products_del', 4),
(13, 'Serviços', 'services_view', 1),
(14, 'Serviços', 'services_add', 2),
(15, 'Serviços', 'services_edit', 3),
(16, 'Serviços', 'services_del', 4),
(17, 'Quartos', 'bedrooms_view', 1),
(18, 'Quartos', 'bedrooms_add', 2),
(19, 'Quartos', 'bedrooms_edit', 3),
(20, 'Quartos', 'bedrooms_del', 4),
(21, 'Reservar/Hospedar', 'hosting_view', 1),
(22, 'Reservar/Hospedar', 'hosting_add', 2),
(23, 'Reservar/Hospedar', 'hosting_edit', 3),
(24, 'Reservar/Hospedar', 'hosting_del', 4),
(25, 'Administrativo', 'management_view', 1);


INSERT INTO `permission_links` (`id_permission_links`, `id_permission_groups`, `id_permission_items`) VALUES
(33, 1, 1),
(34, 1, 5),
(35, 1, 9),
(36, 1, 13),
(37, 1, 17),
(38, 1, 21),
(39, 1, 25),
(40, 1, 2),
(41, 1, 6),
(42, 1, 10),
(43, 1, 14),
(44, 1, 18),
(45, 1, 22),
(46, 1, 3),
(47, 1, 7),
(48, 1, 11),
(49, 1, 15),
(50, 1, 19),
(51, 1, 23),
(52, 1, 4),
(53, 1, 8),
(54, 1, 12),
(55, 1, 16),
(56, 1, 20),
(57, 1, 24);



INSERT INTO `products` (`id_products`, `description`, `price`, `status`) VALUES
(1, 'agua mineral 500 ml', 2.7, 1),
(2, 'Coca-cola lata 330ml', 4, 2),
(3, 'Suco', 7, 1);


INSERT INTO `services` (`id_services`, `description`, `price`, `status`) VALUES
(1, 'Hospedagem Simples', 50, 1),
(2, 'Café da Manhã', 13, 1),
(3, 'Almoço', 17, 1),
(4, 'Hospedagem com café', 60, 2),
(5, 'Jantar', 15, 1),
(6, 'Hospedagem Mensal com café da manhã', 1250, 1);

