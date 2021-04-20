CREATE DATABASE `ass2`;
USE `ass2`;

-- TABLE `accounts`
CREATE TABLE `ass2`.`accounts`(
    `Id`  INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Email` TEXT NOT NULL,
    `Name` VARCHAR(20) NOT NULL,
    `Password` VARCHAR(30) NOT NULL,
    `IsManager` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY(Id)
)ENGINE = InnoDB COLLATE=ucs2_vietnamese_ci;
INSERT INTO `accounts` (`Id`,`Email`, `Name`, `Password`, `IsManager`) VALUES ('10','dolethienan20001@yahoo.com.vn', 'Root1', 'Dolethienan2000', '1');
INSERT INTO `accounts` (`Id`,`Email`, `Name`, `Password`, `IsManager`) VALUES ('1','lilac@yahoo.com.vn', 'lilac0307', 'lilac0307', '0');
INSERT INTO `accounts` (`Id`,`Email`, `Name`, `Password`, `IsManager`) VALUES ('2','an@hcmut.edu.vn', 'lilac', 'lilac0307', '0');

-- TABLE `user accounts`
CREATE TABLE `ass2`.`user accounts`(
    `Id` INT(11) UNSIGNED NOT NULL,
    `Phone` INT NULL ,
    `First Name` TEXT NULL ,
    `Last Name` TEXT NULL,
     `Creation Date` timestamp default now(),
     FOREIGN KEY (Id) REFERENCES accounts(Id)
     ON DELETE CASCADE
     ON UPDATE CASCADE,
     PRIMARY KEY (Id)
)ENGINE = InnoDB COLLATE=ucs2_vietnamese_ci;
INSERT INTO `user accounts` (`Id`) VALUES ('1');
INSERT INTO `user accounts` (`Id`) VALUES ('2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

-- TABLE `products`
CREATE TABLE `ass2`.`products`(
    `id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(100) DEFAULT NULL,
    `description` varchar(250) DEFAULT NULL,
    `quantity` int(11) DEFAULT NULL,
    `price` int(11) DEFAULT NULL,
    `size` varchar(255) DEFAULT NULL,
    `rate` float DEFAULT NULL,
    `Creation Date` timestamp default now(),
    PRIMARY KEY(id)
) ENGINE = InnoDB COLLATE=ucs2_vietnamese_ci;



--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`, `description`, `size`, `rate`) VALUES
(1, 'adidas RUNNING Giày Edge XT Nam Màu xanh dương EG9703', 100, 2800000, 'Lace closure,\r\nTextile upper\r\n,Breathable SUMMER.RDY,Lightweight running shoes\r\n,Bounce Lite midsole cushioning\r\n,TEXTILE/SYNTHETICS', '38,39,40,41,42,43,44', 4.5),
(2, 'Giày Thể Thao Adidas TENNIS Courtmaster Nữ Màu trắng FW2897', 100, 2000000, 'Có dây buộc\r\n,Thân giày bằng da với các chi tiết bằng da lộn, da nubuck và da PU\r\n,Cảm giác êm ái\r\n,Giày tennis thời trang\r\n,Lót giày công nghệ Cloudf', '36,37,38,39,40,41', 4.5),
(3, 'Giày Thể Thao Nike Nam Chạy Bộ Thời Trang Rival AA7400-401', 100, 1600000, 'Thiết kế thân lưới tạo cảm giác thông thoáng cho bàn chân,\r\nĐế giữa và miếng lót cho lớp đệm chân mỏng nhẹ êm ái,\r\nĐế giày xẻ rãnh chống trơn trượt', '41,42,42.5,43', 5),
(4, 'Giày Thể Thao Nike Nam Chạy Bộ FA19 FLEX 2019 RN AQ7483-007', 100, 1800000, 'Thiết kế thân lưới tạo cảm giác thông thoáng cho bàn chân\r\n,Đế giữa và miếng lót cho lớp đệm chân mỏng nhẹ êm ái,\r\nĐế giày xẻ rãnh chống trơn trượt', '41,42,42.5,43', 4),
(5, 'Giày Thể Thao Nike Nam Chạy Bộ CARRY OVER Brandoutlet 908987-001', 100, 1600000, 'Thiết kế thân lưới tạo cảm giác thông thoáng cho bàn chân\r\n,Đế giữa và miếng lót cho lớp đệm chân mỏng nhẹ êm ái,\r\nĐế giày xẻ rãnh chống trơn trượt', '41,42,42.5,43', 4.5),
(6, 'Áo adidas NOT SPORTS SPECIFIC Màu xanh dương FP7303', 100, 850000, 'Cổ tròn có gân\r\n,Vải jersey một mặt phải làm từ 100% cotton\r\n,Áo phông họa tiết graphic\r\n,Đường xẻ hai bên gấu áo\r\n', 'XL,S,M,L', 5),
(7, 'Quần short Club 3 adidas TENNIS Nam Màu đen DU0874', 100, 700000, '\r\nVải dệt trơn làm từ 100% polyester tái chế\r\n,Túi mở hai bên,Cạp chun có dây rút\r\n,Công nghệ thoáng khí Climacool\r\n,Các mảng phối lưới thoáng khí ở phần ống trong và hông sau', 'XL,S,M,L', 3.5),
(8, 'adidas TRAINING Áo phông rằn ri Nam Màu trắng FM2119', 100, 600000, '\r\nÔm vừa\r\n,Cổ tròn\r\n,Vải dệt interlock làm từ 100% polyester tái chế\r\n,Áo phông rằn ri hỗ trợ vận động\r\n,Thiết kế FreeLift\r\n,Công nghệ AEROREADY thấm hút ẩm\r\n', 'XL,S,M,L', 4.5),
(9, 'adidas NOT SPORTS SPECIFIC Áo phông Nữ Màu hồng FN6551', 100, 850000, 'Cổ tròn rộng có gân sọc\r\n,Vải jersey một mặt phải làm từ 100% cotton\r\n,Áo phông cộc tay\r\n,Đường xẻ hai bên gấu áo\r\n,Chúng tôi hợp tác với chương trình Better Cotton Initiative để cải thiện ngành trồng bông trên toàn cầu\r\n', 'XL,S,M,L', 5),
(10, 'adidas TRAINING Áo thun thể thao Tokyo Nam Màu đen FS3659', 100, 700000, '\r\nÁo thun tập thể thao họa tiết adidas\r\n,Chất liệu AEROREADY hút ẩm\r\n,FreeLift design\r\n,Garments made with Primegreen use a minimum of 40% recycled content.\r\n,100% rec polyester\r\n', 'XL,S,M,L', 4),
(11, 'adidas ORIGINALS Trefoil Tee Nữ Màu đen FM3311', 100, 700000, '92% cotton, 8% elastane single jersey\r\n,Soft feel\r\n,Everyday Trefoil logo tee\r\n,Large Trefoil logo print\r\n,We partner with the Better Cotton Initiative to improve cotton farming globally\r\n,92% Cotton/8% Elasthane\r\n', 'XL,S,M,L', 4.5),
(12, 'adidas ORIGINALS 3 đôi tất Trefoil Liner Unisex Màu đen S20274', 100, 400000, '\r\nMỗi bộ sản phẩm có ba đôi\r\n,Gấu gân\r\n,Hình Trefoil trên mũi chân\r\n,Chất vải co giãn nhẹ\r\n,Cổ ngắn\r\n,Vải làm từ 73% cotton / 22% polyester / 3% nylon / 2% elastane\r\n', 'XL,S,M,L', 4.5),
(13, 'adidas ORIGINALS Giày ZX 2K Boost Unisex nữ Màu trắng FY1942', 100, 2500000, '\r\nCó dây buộc\r\n,Thân giày bằng vải lưới và TPU\r\n,Lót giày OrthoLite®\r\n,Giày tập phản quang\r\n,Đế giữa Boost đặc trưng\r\n', '38,39,40,41,42', 5),
(14, 'adidas ORIGINALS Giày Boost Unisex nam Màu trắng FX9519', 100, 2500000, '\r\nCó dây buộc\r\n,Thân giày bằng vải lưới và TPU\r\n,Lót giày OrthoLite®\r\n,Giày tập phản quang\r\n,Đế giữa Boost đặc trưng\r\n', '40,41,42,43,44', 4),
(15, 'Quần shorts adidas ORIGINALS 3-Stripes Nữ Màu đen FM2610', 100, 850000, '\r\nThắt lưng co dãn\r\n,100% polyeste tái chế tricot\r\n,Quần đùi nhẹ thông thường\r\n,Túi trước\r\n,Khe bên\r\n,Những chiếc quần đùi này được làm bằng polyester tái chế để tiết kiệm tài nguyên và giảm lượng khí thải\r\n,100% polyester tái tạo\r\n', 'XS,S,M,L,XL', 4.5),
(16, 'Áo thun adidas NOT SPORTS SPECIFIC Nữ Màu đen GH3798', 100, 700000, 'Cổ thuyền có gân\r\n,48% cotton 47% modal 5% elastane single jersey\r\n,Áo thun 3 sọc\r\n,Không Bảo Hành\r\n,Xuất Xứ Thương Hiệu: Đức\r\n', 'XS,S,M,L,XL', 4.5),
(17, 'adidas ORIGINALS Áo phông Trefoil Unisex Màu đen DV2905', 100, 600000, '\r\n,Cổ tròn có gân\r\n,Cộc tay\r\n,Vải jersey một mặt phải làm từ 100% cotton\r\n,Cảm giác mềm mại\r\n,Logo Trefoil lớn\r\n,Chúng tôi hợp tác với chương trình Better Cotton Initiative để cải thiện ngành trồng bông trên toàn cầu\r\n', 'XS,S,M,L,XL', 3),
(18, 'Giày bóng rổ PEAK Tony Parker Outdoor EW94091A màu Xanh', 100, 900000, '\r\nThân giày: chất liệu vải dệt mềm nhẹ thoáng khí mũi giày được bọc một lớp da tổng hợp bảo vệ bàn chân khỏi các va chạm trên sân. \r\n\r\n,Gót giày được bao bọc bởi vật liệu TPU cứng bảo vệ cổ chân và gót chân trong các chuyển động mạnh hay khi tiếp đấ', '41,42,43,44,45', 4.5);

--
-- Cấu trúc bảng cho bảng `products_images`
--

CREATE TABLE `products_images` (
  `id_img` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  FOREIGN KEY (product_id) REFERENCES products(Id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  PRIMARY KEY (id_img)
) ENGINE=InnoDB COLLATE=ucs2_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `products_images`
--

INSERT INTO `products_images` (`id_img`, `product_id`, `filename`) VALUES
(1, 1, 'http://vn-test-11.slatic.net/p/4b81d54bd23337122638ee4c5c300e17.jpg_720x720q80.jpg_.webp'),
(2, 1, 'http://vn-test-11.slatic.net/p/51080a95305be4a5ff075be232b313b2.jpg_720x720q80.jpg_.webp'),
(3, 1, 'http://vn-test-11.slatic.net/p/88a0de858c2fd9a1f7507f89638f9149.jpg_720x720q80.jpg_.webp'),
(4, 1, 'http://vn-test-11.slatic.net/p/a15bc90f2aff1726a427aeca825f118f.jpg_720x720q80.jpg_.webp'),
(5, 2, 'https://cf.shopee.vn/file/9072dc95dbb4c5a0070bdf87b637531d'),
(6, 2, 'https://cf.shopee.vn/file/bc8598788fc55f1a95366ae16c62dafb'),
(7, 2, 'https://cf.shopee.vn/file/9210363522cc5830149dab01d206902a'),
(8, 2, 'https://cf.shopee.vn/file/b57a8b20b144e286295b46c0020ec002'),
(9, 3, 'https://cf.shopee.vn/file/79393485da3e6d2e5d7bf82d22a4aec6'),
(10, 3, 'https://cf.shopee.vn/file/f50bcf5465d7b87714221e47a73aa5de'),
(11, 3, 'https://cf.shopee.vn/file/c10d3f20943c6c275a72f78e0a7918a5'),
(12, 3, 'https://cf.shopee.vn/file/8ea82183f3efde541345d39caa394487'),
(13, 4, 'https://cf.shopee.vn/file/07babc86525d18017a3e613fa5c74646'),
(14, 4, 'https://cf.shopee.vn/file/9c9f3773353b8b2fb4877e55d537326d'),
(15, 4, 'https://cf.shopee.vn/file/cec3d975e9a400c81fd86eaf8c74b6e1'),
(16, 4, 'https://cf.shopee.vn/file/1d40ffea1e29ca244a49222d66d09db6'),
(17, 5, 'https://cf.shopee.vn/file/be7b08ee0306418f0cd0d8c9f266c034'),
(18, 5, 'https://cf.shopee.vn/file/f0529cd1d88091b92748462cff63af41'),
(19, 5, 'https://cf.shopee.vn/file/e2db646cbd742a882217a1c73ecfef03'),
(20, 5, 'https://cf.shopee.vn/file/a4ab78ca25c8c917a30e46d0bacab5a1'),
(21, 6, 'https://cf.shopee.vn/file/3134235e3e246c94fc0997349d5be32d'),
(22, 6, 'https://cf.shopee.vn/file/10a760e012bc147ab213cef37f6f38ec'),
(23, 6, 'https://cf.shopee.vn/file/9bbd54448fb9e584cca9b4c1925c1df6'),
(24, 6, 'https://cf.shopee.vn/file/2422e40f7224d65cbb2d7b3d86308f3e'),
(25, 7, 'https://cf.shopee.vn/file/401a76ea8ffb5da9c2cb5b01f08017dc'),
(26, 7, 'https://cf.shopee.vn/file/2cae7ff1379d92801073dba4871186db'),
(27, 7, 'https://cf.shopee.vn/file/fa5defa0f09de37ee3af80d6952fda20'),
(28, 7, 'https://cf.shopee.vn/file/6bf85773ef2caef16132e06d3aa1ca2a'),
(29, 8, 'https://cf.shopee.vn/file/f8f12ba2159ef010bd587a3c73c90f4e'),
(30, 8, 'https://cf.shopee.vn/file/f965679b2b500d580b5646702d7f0780'),
(31, 8, 'https://cf.shopee.vn/file/a9770f4e41c3427c76723a172c890a51'),
(32, 8, 'https://cf.shopee.vn/file/f66da9d9d9cd9761353f1e659445e30e'),
(33, 9, 'https://cf.shopee.vn/file/e8c4fde36c0ce0493f59cbd4254e630d'),
(34, 9, 'https://cf.shopee.vn/file/6c2550d1b0620b13297e51f91cb6aea2'),
(35, 9, 'https://cf.shopee.vn/file/9fe7f7f782706f89680e1e972ade31f0'),
(36, 9, 'https://cf.shopee.vn/file/861e11e4ac85b4c4b0c5ea4a102ae5e5'),
(37, 10, 'https://cf.shopee.vn/file/f4528ea85955d7d2ad7c03f074492885'),
(38, 10, 'https://cf.shopee.vn/file/980be8faef1aae24a462586f6b3b8443'),
(39, 10, 'https://cf.shopee.vn/file/98d62cc6d7ea5f8ee90d82a94fc8cb37'),
(40, 10, 'https://cf.shopee.vn/file/5fcc0911c34fc499bdcb8b7df59cf75e'),
(41, 11, 'https://cf.shopee.vn/file/6751fc493a7d6b51c3e26b76cb08696b'),
(42, 11, 'https://cf.shopee.vn/file/cdc685804366535af14ad6d97e80c217'),
(43, 11, 'https://cf.shopee.vn/file/e66afe76efe2c44f17630150fbfc92bc'),
(44, 11, 'https://cf.shopee.vn/file/4bd3b0ad234ecae27f46f8d7912c3e1c'),
(45, 12, 'https://cf.shopee.vn/file/182b97b3acc6a1cb077404c9803bcbab'),
(46, 12, 'https://cf.shopee.vn/file/a73f0c765c7597bc41909097e36578ef'),
(47, 12, 'https://cf.shopee.vn/file/0991dbe098352ddc5f90446a4ef527cf'),
(48, 12, 'https://cf.shopee.vn/file/c2a0dccccca88d48ac7b6fcd2f21c8a9'),
(49, 13, 'https://cf.shopee.vn/file/5d0c1715a6c1ae51c0c51a1c870e5c78'),
(50, 13, 'https://cf.shopee.vn/file/afad605c70f225ba6356df97c950c92d'),
(51, 13, 'https://cf.shopee.vn/file/97e8954a6f08e21990c9ce71e9808bac'),
(52, 13, 'https://cf.shopee.vn/file/3f78bc72d97017b986fa9eca2f57bd41'),
(53, 14, 'https://cf.shopee.vn/file/e57ecabc34a8b9d6cf4764bd4adf592f'),
(54, 14, 'https://cf.shopee.vn/file/4d473dd4bed58ade7cc2312f635ba759'),
(55, 14, 'https://cf.shopee.vn/file/502d9ba36b0acd3dff96287151adf240'),
(56, 14, 'https://cf.shopee.vn/file/b53bcfe628b947d4267f86972f132a49'),
(57, 15, 'https://cf.shopee.vn/file/b11b84a4741f6fa0e82186eed0adff14'),
(58, 15, 'https://cf.shopee.vn/file/8c037180b82af536e26e5742e9d2a664'),
(59, 15, 'https://cf.shopee.vn/file/78ce367afe819294e3c0d67d8587e2d7'),
(60, 15, 'https://cf.shopee.vn/file/7a0abca6240990cfd0d33f04b7e06140'),
(61, 16, 'https://cf.shopee.vn/file/8bfe378d9ea3cb5efc9c7c54b8e59003'),
(62, 16, 'https://cf.shopee.vn/file/3853d8a2def812a751769d360d605571'),
(63, 16, 'https://cf.shopee.vn/file/302b5b535c537ed368a02667162bfe76'),
(64, 16, 'https://cf.shopee.vn/file/59f4868ee1b855af451cb938d333f09a'),
(65, 17, 'https://cf.shopee.vn/file/d02f25c9c2f77b1faf106a005159ca96'),
(66, 17, 'https://cf.shopee.vn/file/5c527c60ab0407492ff37525900fad80'),
(67, 17, 'https://cf.shopee.vn/file/48c51b0739b82c1adf0015d832865484'),
(68, 17, 'https://cf.shopee.vn/file/7ed07979bd9c9d18fdd47d4fcedb61cc'),
(69, 18, 'https://cf.shopee.vn/file/ae4323935b7bedf73a530e0f0ad7a06a'),
(70, 18, 'https://cf.shopee.vn/file/1402b8d06326dca6c4d5e07ba4c38715'),
(71, 18, 'https://cf.shopee.vn/file/3eb05e940c27b5fc86e09ab98ad42747'),
(72, 18, 'https://cf.shopee.vn/file/b658d5317e0e388dc3aa6ba337cf5b16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--
CREATE TABLE `ass2`.`carts` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` int(11) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_product` varchar(255) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  FOREIGN KEY (userid) REFERENCES accounts(Id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  FOREIGN KEY (productId) REFERENCES products(Id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  PRIMARY KEY(id)
) ENGINE=InnoDB COLLATE=ucs2_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `userid`, `price`, `quantity`, `size`, `name`, `image_product`, `productId`) VALUES
(70, 1, 850000, 3, 'S', 'Áo adidas NOT SPORTS SPECIFIC Màu xanh dương FP7303', 'https://cf.shopee.vn/file/3134235e3e246c94fc0997349d5be32d', 6),
(71, 1, 850000, 2, 'S', 'Áo adidas NOT SPORTS SPECIFIC Màu xanh dương FP7303', 'https://cf.shopee.vn/file/3134235e3e246c94fc0997349d5be32d', 6),
(72, 1, 1600000, 2, '42', 'Giày Thể Thao Nike Nam Chạy Bộ CARRY OVER Brandoutlet 908987-001', 'https://cf.shopee.vn/file/be7b08ee0306418f0cd0d8c9f266c034', 5),
(73, 1, 2500000, 1, '43', 'adidas ORIGINALS Giày Boost Unisex nam Màu trắng FX9519', 'https://cf.shopee.vn/file/e57ecabc34a8b9d6cf4764bd4adf592f', 14),
(74, 1, 700000, 1, 'Chọn kích thước', 'adidas ORIGINALS Trefoil Tee Nữ Màu đen FM3311', 'https://cf.shopee.vn/file/6751fc493a7d6b51c3e26b76cb08696b', 11);

-- --------------------------------------------------------
