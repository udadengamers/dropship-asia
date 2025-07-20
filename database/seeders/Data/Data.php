<?php

namespace Database\Seeders\Data;

class Data
{
    public $products = [
        [
            'name' => 'Classic White T-Shirt',
            'sku' => 'CT-01',
            'category_id' => 2,
            'description' => 'This classic white t-shirt is a wardrobe staple. Made from high-quality cotton, it features a relaxed fit and a ribbed crew neckline. Wear it with jeans and sneakers for a casual look or dress it up with a blazer and trousers.',
            'price' => 29.99,
            'state' => 'active',
            'stock' => [
                [
                    'name' => 'S',
                    'quantity' => 10000,
                    'price' => 29.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'M',
                    'quantity' => 10000,
                    'price' => 29.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'L',
                    'quantity' => 10000,
                    'price' => 29.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'XL',
                    'quantity' => 10000,
                    'price' => 29.99,
                    'state' => 'active',
                ],
            ],
            'images' => [
                'https://media.gq.com/photos/5e839e814ce9d900093a32eb/master/w_2000,h_1333,c_limit/Kirkland-Signature-crew-neck-T-shirts-(6-pack).jpg',
                'https://media.gq.com/photos/5e839e84d73e2d00084f1a4f/master/w_1280,c_limit/Uniqlo-U-crew-neck-short-sleeve-T-shirt.jpg',
                'https://media.gq.com/photos/629e338f04f4df53d8f370c4/master/w_1280,c_limit/gqteeshirt2.jpg',
            ],
        ],
        [
            'name' => 'Graphic Print T-Shirt',
            'sku' => 'GP-02',
            'category_id' => 2,
            'description' => 'Make a statement with this graphic print t-shirt. The bold design features a mix of colors and textures, making it a unique addition to your wardrobe. The cotton fabric is soft and comfortable, while the regular fit provides a relaxed look.',
            'price' => 39.99,
            'state' => 'active',
            'stock' => [
                [
                    'name' => 'S',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'M',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'L',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'XL',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
            ],
            'images' => [
                'https://cdn07.nnnow.com/web-images/large/styles/EE2WDM4XBNY/1629958717694/1.jpg',
                'https://cdn11.nnnow.com/web-images/large/styles/EE2WDM4XBNY/1629958717691/2.JPG',
                'https://cdn12.nnnow.com/web-images/large/styles/EE2WDM4XBNY/1629958717693/3.JPG',
            ],
        ],
        [
            'name' => 'Vintage Wash T-Shirt',
            'sku' => 'VW-03',
            'category_id' => 2,
            'description' => 'Get a cool, vintage look with this washed t-shirt. The cotton fabric has been treated for a worn-in, soft feel, and the regular fit provides a relaxed look. Pair it with your favorite jeans for an effortless, casual outfit.',
            'price' => 49.99,
            'state' => 'active',
            'stock' => [
                [
                    'name' => 'S',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'M',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'L',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'XL',
                    'quantity' => 10000,
                    'price' => 39.99,
                    'state' => 'active',
                ],
            ],
            'images' => [
                'https://cdn09.nnnow.com/web-images/large/styles/LBWKIOI3AVP/1677137536297/1.jpg',
                'https://cdn12.nnnow.com/web-images/large/styles/LBWKIOI3AVP/1677137536282/4.jpg',
            ],
        ],
        [
            'name' => 'Nike Air Max 90',
            'sku' => 'nike-air-max-90',
            'category_id' => 3,
            'description' => 'The Nike Air Max 90 is a classic sneaker that features a durable leather and mesh upper, visible Max Air cushioning in the heel, and a rubber outsole for traction and durability. This shoe has a timeless design and is perfect for both casual wear and athletic activities.',
            'price' => 120,
            'quantity' => 10000,
            'state' => 'active',
            'images' => [
                'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/029d86dd-1549-4221-a18b-25d165998d1f/air-max-90-se-shoes-ltJLHs.png',
                'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/eceb6b53-06fc-4182-a450-b16620dc5295/air-max-90-se-shoes-ltJLHs.png',
            ]
        ],
        [
            'name' => 'Adidas Ultraboost 21',
            'sku' => 'adidas-ultraboost-21',
            'category_id' => 3,
            'description' => 'The Adidas Ultraboost 21 is a high-performance running shoe that features an advanced cushioning system and a lightweight yet durable construction. The shoe is designed to provide maximum comfort and support for runners of all levels.',
            'price' => 180,
            'quantity' => 10000,
            'state' => 'active',
            'images' => [
                'https://images.tokopedia.net/img/cache/500-square/VqbcmM/2021/12/3/34a47b1b-15d5-48a8-947c-fb023bbf48ae.jpg',
                'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/b8f0467e979e4855aba7ad5600c304ec_9366/Ultraboost_21_Shoes_Grey_S23875_01_standard.jpg'
            ]
        ],
        [
            'name' => 'Levi\'s 501 Jeans',
            'sku' => 'levis-501-jeans',
            'category_id' => 7,
            'description' => 'The Levi\'s 501 is an iconic pair of jeans that features a classic straight leg, a button fly, and a timeless design. The jeans are made from high-quality denim and are built to last, making them a great choice for anyone looking for a durable and stylish pair of pants.',
            'price' => 80,
            'quantity' => 10000,
            'state' => 'active',
            'images' => [
                'https://cdn16.nnnow.com/web-images/large/styles/XD86IOOTR4C/1494848426163/1.jpg',
                'https://cdn08.nnnow.com/web-images/large/styles/XD86IOOTR4C/1494848426168/4.jpg'
            ]
        ],
        [
            'name' => 'Cotton T-Shirt',
            'sku' => 'CT1001',
            'category_id' => 2,
            'description' => 'A comfortable and breathable cotton t-shirt, perfect for casual wear. Comes in multiple colors.',
            'price' => 25.99,
            'state' => 'active',
            'stock' => [
                [
                    'name' => 'Small',
                    'quantity' => 10000,
                    'price' => 25.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Medium',
                    'quantity' => 10000,
                    'price' => 25.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Large',
                    'quantity' => 10000,
                    'price' => 25.99,
                    'state' => 'active',
                ],
            ],
            'images' => [
                'https://cdn02.nnnow.com/web-images/large/styles/K13WPSU4ZVW/1676375529390/1.jpg',
                'https://cdn01.nnnow.com/web-images/large/styles/K13WPSU4ZVW/1676375529388/3.jpg',
            ],
        ],
        [
            'name' => 'Denim Jeans',
            'sku' => 'DJ2001',
            'category_id' => 7,
            'description' => 'A classic pair of denim jeans, suitable for any occasion. Comes in various sizes and styles.',
            'price' => 89.99,
            'quantity' => 10000,
            'state' => 'active',
            'images' => [
                'https://cdn06.nnnow.com/web-images/large/styles/EGDOYLHD8FB/1509702488644/1.jpg',
                'https://cdn18.nnnow.com/web-images/large/styles/EGDOYLHD8FB/1509702488646/3.jpg',
            ],
        ],
        [
            'name' => 'Leather Jacket',
            'sku' => 'LJ3001',
            'category_id' => 8,
            'description' => 'A stylish and durable leather jacket, perfect for colder weather. Available in multiple colors.',
            'price' => 299.99,
            'quantity' => 10000,
            'state' => 'active',
            'images' => [
                'https://cdn13.nnnow.com/web-images/large/styles/RVSM6SJ6TD8/1608046125171/1.jpg',
                'https://cdn19.nnnow.com/web-images/large/styles/RVSM6SJ6TD8/1608046125173/3.jpg',
            ],
        ],
        [
            'name' => 'Red T-Shirt',
            'sku' => 'rt001',
            'category_id' => 2,
            'description' => 'This red t-shirt is made from high-quality cotton and is incredibly comfortable. It is perfect for everyday wear and will keep you looking stylish.',
            'state' => 'active',
            'images' => [
                'https://cdn05.nnnow.com/web-images/large/styles/KXQD9TAA1W2/1580280716844/1.jpg',
                'https://cdn16.nnnow.com/web-images/large/styles/KXQD9TAA1W2/1580280716837/2.jpg',
            ],
            'stock' => [
                [
                    'name' => 'S',
                    'quantity' => 10000,
                    'price' => 2500,
                    'state' => 'active',
                ],
                [
                    'name' => 'M',
                    'quantity' => 10000,
                    'price' => 2500,
                    'state' => 'active',
                ],
                [
                    'name' => 'L',
                    'quantity' => 10000,
                    'price' => 2500,
                    'state' => 'active',
                ],
                [
                    'name' => 'XL',
                    'quantity' => 10000,
                    'price' => 2500,
                    'state' => 'active',
                ]
            ]
        ],
        [
            'name' => 'Leather Shoes',
            'sku' => 'ls001',
            'category_id' => 3,
            'description' => 'These leather shoes are perfect for formal occasions. They are made from high-quality leather and are extremely comfortable to wear.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 250,
            'images' => [
                'https://cdn14.nnnow.com/web-images/large/styles/3AGFDPEZ281/1665827696931/1.jpg',
                'https://cdn11.nnnow.com/web-images/large/styles/3AGFDPEZ281/1665827696928/2.jpg',
                'https://cdn05.nnnow.com/web-images/large/styles/3AGFDPEZ281/1665827696930/3.jpg'
            ]
        ],
        [
            'name' => 'Blue Jeans',
            'sku' => 'bj001',
            'category_id' => 7,
            'description' => 'These blue jeans are made from high-quality denim and are incredibly comfortable. They are perfect for casual wear and will keep you looking stylish.',
            'state' => 'active',
            'images' => [
                'https://cdn01.nnnow.com/web-images/large/styles/KNHA9YBME3B/1547703407000/1.jpg',
                'https://cdn07.nnnow.com/web-images/large/styles/KNHA9YBME3B/1547703406999/3.jpg',
                'https://cdn16.nnnow.com/web-images/large/styles/KNHA9YBME3B/1547703406993/4.jpg'
            ],
            'stock' => [
                [
                    'name' => '30',
                    'quantity' => 10000,
                    'price' => 4500,
                    'state' => 'active',
                ],
                [
                    'name' => '32',
                    'quantity' => 10000,
                    'price' => 4500,
                    'state' => 'active',
                ],
                [
                    'name' => '34',
                    'quantity' => 10000,
                    'price' => 4500,
                    'state' => 'active',
                ],
                [
                    'name' => '36',
                    'quantity' => 10000,
                    'price' => 4500,
                    'state' => 'active',
                ]
            ]
        ],
        [
            'name' => 'iPhone 13 Pro',
            'sku' => 'iphone_13_pro',
            'category_id' => 1,
            'quantity' => 23,
            'price' => 2500,
            'description' => 'The iPhone 13 Pro features a ProMotion display with a 120Hz refresh rate, a new A15 Bionic chip, and a triple-camera system with improved low-light performance. With support for 5G, Face ID, and a durable Ceramic Shield front cover, this phone is ready for anything.',
            'state' => 'active',
            'images' => [
                'https://www.apple.com/newsroom/images/product/iphone/standard/Apple_iPhone-13-Pro_Colors_09142021_big.jpg',
                'https://www.apple.com/newsroom/images/product/iphone/standard/Apple_iPhone-13-Pro_iPhone-13-Pro-Max_09142021_inline.jpg',
            ]
        ],
        [
            'name' => 'Samsung Galaxy S21',
            'sku' => 'samsung_galaxy_s21',
            'quantity' => 20,
            'price' => 2500,
            'category_id' => 1,
            'description' => 'The Samsung Galaxy S21 features a 6.2-inch AMOLED display, a Snapdragon 888 chipset, and a triple-camera system with up to 64MP resolution. With 5G support, an in-display fingerprint sensor, and Samsung Pay, this phone offers advanced features in a sleek and durable package.',
            'state' => 'active',
            'images' => [
                'https://cdn-2.tstatic.net/bangka/foto/bank/images/20221023-Harga-Samsung-S21-Ultra-5G.jpg',
                'https://freeshopdirecto.com/venezuela/127-large_default/galaxy-s21-ultra-5g.jpg',
                'https://freeshopdirecto.com/venezuela/128-large_default/galaxy-s21-ultra-5g.jpg'
            ]
        ],
        [
            'name' => 'Sony PlayStation 5',
            'sku' => 'sony_playstation_5',
            'category_id' => 1,
            'quantity' => 13,
            'price' => 3500,
            'description' => 'The Sony PlayStation 5 is the latest gaming console from Sony, with support for ray tracing, 4K resolution, and up to 120fps gameplay. With a custom AMD Zen 2 CPU and RDNA 2 GPU, this console delivers stunning graphics and lightning-fast performance.',
            'state' => 'active',
            'images' => [
                'https://asset.kompas.com/crops/OShkHBI40cCFj6mMFFcYmhbhBaw=/187x12:1126x638/750x500/data/photo/2020/06/12/5ee2bae6901d6.jpg',
                'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//89/MTA-10241647/sony_sony_playstation_ps5_digital_edition_console_video_game_japan_set_full01_qd9oi0c9.jpg',
                'https://asset.kompas.com/crops/1C-M-9auIGQ6NICQLHdac3T88ME=/131x95:935x631/750x500/data/photo/2020/06/12/5ee2d91340862.jpg'
            ]
        ],
        [
            'name' => 'MAC Cosmetics Matte Lipstick',
            'sku' => 'mac_matte_lipstick',
            'category_id' => 6,
            'quantity' => 20,
            'price' => 20.50,
            'description' => 'The MAC Cosmetics Matte Lipstick is a creamy, richly pigmented lipstick that provides bold, full coverage. It has a long-lasting, matte finish that won\'t dry out your lips. Available in a range of shades to complement any skin tone and outfit.',
            'state' => 'active',
            'images' => [
                'https://static-id.zacdn.com/p/mac-cosmetics-8588-1056404-1.jpg',
                'https://cdn.nicehair.dk/products/94670/thumbnails/mac-matte-lipstick-3-gr-mehr-1625141707.jpg'
            ]
        ],
        [
            'name' => 'LOreal Paris Voluminous Original Mascara',
            'sku' => 'loreal_voluminous_mascara',
            'category_id' => 6,
            'quantity' => 30,
            'price' => 9.99,
            'description' => 'The LOreal Paris Voluminous Original Mascara is a volumizing and lengthening mascara that delivers bold and dramatic lashes. The formula is smudge-proof and flake-proof, and the unique brush design makes it easy to apply. Suitable for all eye types.',
            'state' => 'active',
            'images' => [
                'https://m.media-amazon.com/images/I/61SoyiDdnvL._SY879_.jpg',
                'https://m.media-amazon.com/images/I/71nG3ExTJzL._SY879_.jpg',
                'https://m.media-amazon.com/images/I/71wNVSsxlwL._SX679_.jpg'
            ]
        ],
    ];

    public $product_v_one = [
        [
            'name' => 'Xiaomi Poco X5 5G',
            'sku' => 'xpx5g_xiaomi',
            'category_id' => 1,
            'description' => 'It has a 6.67" AMOLED DotDisplay screen. POCO X5 5G is equipped with a 120Hz AMOLED screen, superior to others.',
            'state' => 'active',
            'images' => [
                'https://i01.appmifile.com/v1/MI_18455B3E4DA706226CF7535A58E875F0267/pms_1675837496.36572913!800x800!85.png',
                'https://i01.appmifile.com/v1/MI_18455B3E4DA706226CF7535A58E875F0267/pms_1675837842.92112756!800x800!85.png',
                'https://cf.shopee.co.id/file/id-11134201-23020-jonm6r43msnv00'
            ],
            'stock' => [
                [
                    'name' => '6/128',
                    'quantity' => 10000,
                    'price' => 349,
                    'state' => 'active',
                ],
                [
                    'name' => '8/256',
                    'quantity' => 10000,
                    'price' => 399,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'HP VICTUS GAMING 15 FA0011TX I5 12500H',
            'sku' => 'HVICTUSG15FA0011TXI512500H',
            'category_id' => 1,
            'description' => 'HP VICTUS 15 FA0011TX - i5-12500H 8GB RTX3050 512GB SSD 15.6"FHD 144Hz.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/sg-11134201-23020-2ck144as4zmv60',
                'https://down-id.img.susercontent.com/file/065a0568ea221e53b8cfd464704765ca',
                'https://down-id.img.susercontent.com/file/2fbe0143237c225ce8807dae7b1f10c4',
            ],
            'stock' => [
                [
                    'name' => '8GB',
                    'quantity' => 10000,
                    'price' => 1219,
                    'state' => 'active',
                ],
                [
                    'name' => '16GB',
                    'quantity' => 10000,
                    'price' => 1259,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'Lenovo Ideapad Gaming 3',
            'sku' => 'LNVIDP_G3',
            'category_id' => 1,
            'description' => 'Step up to the power of 2nd generation RTX with GeForce RTX™ 3050 laptop family.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/sg-11134201-22110-1ybwil7fg3jvd8',
                'https://down-id.img.susercontent.com/file/e8c4487f8f7b597caab63c14da54091a',
                'https://down-id.img.susercontent.com/file/1a7f8f7874c016e27817c3b6aca4ae7d',
                'https://down-id.img.susercontent.com/file/f950c30c88a3b67a15baa12cfda4d02b',
            ],
            'stock' => [
                [
                    'name' => '8GB',
                    'quantity' => 10000,
                    'price' => 1179,
                    'state' => 'active',
                ],
                [
                    'name' => '16GB',
                    'quantity' => 10000,
                    'price' => 1219,
                    'state' => 'active',
                ],
                [
                    'name' => '24GB',
                    'quantity' => 10000,
                    'price' => 1259,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'LED SMART TV XIAOMI 32M7 A2 32 Inch DIGITAL',
            'sku' => 'ls001smrttv32',
            'category_id' => 1,
            'description' => 'The ultra-narrow bezel design provides a much higher screen-to-body ratio than standard TVs. When you turn on the TV, high-resolution images in stunning colors will decorate your TV screen for an immersive viewing experience.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 229,
            'images' => [
                'https://images.tokopedia.net/img/cache/500-square/VqbcmM/2022/9/6/5360dcfb-1a45-43db-9209-1d0876dd8c41.jpg',
                'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//107/MTA-54741878/xiaomi_xiaomi-tv-a2-32-32m7-hd-tv-smart-tv-garansi-resmi-100-ori_full03.jpg',
            ]
        ],
        [
            'name' => 'Q&Q QZ02J Series',
            'sku' => 'QNQOML_AW43242',
            'category_id' => 5,
            'description' => 'Original Mens Leather Strap Analog Watch Japan Brand.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 29,
            'images' => [
                'https://qnq.co.id/wp-content/uploads/2019/04/S306J302Y.jpg',
                'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium/MTA-2577877/q-q_q-q-analog-watch-jam-tangan-pria--q978j1y--original-_full10.jpg',
            ]
        ],
        [
            'name' => 'Consina Besseggen Laptop Backpack',
            'sku' => 'CUNSX_ON1234',
            'category_id' => 4,
            'description' => 'Product for unisex, daily, light traveling, light trekking.',
            'state' => 'active',
            'images' => [
                'https://www.consina.com/wp-content/uploads/2022/07/kilt-rock-bk5-1-1600x1600.jpg',
                'https://www.consina.com/wp-content/uploads/2022/09/bassagen-dbl1-1600x1600.jpg',
                'https://images.tokopedia.net/img/cache/700/hDjmkQ/2022/11/28/0b8623a0-7a38-4e47-a25e-08c18e20ca3f.jpg',
            ],
            'stock' => [
                [
                    'name' => 'Black',
                    'quantity' => 10000,
                    'price' => 35,
                    'state' => 'active',
                ],
                [
                    'name' => 'Dark Blue',
                    'quantity' => 10000,
                    'price' => 35,
                    'state' => 'active',
                ],
                [
                    'name' => 'Light Brown',
                    'quantity' => 10000,
                    'price' => 36,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'Xiaomi Mi Band 6 Smart Watch',
            'sku' => 'XIMI_SMWTCH6',
            'category_id' => 1,
            'description' => 'Automatic recognition of 6 kinds of sports:automatic recognition of walking, treadmill, outdoor running, outdoor riding, rowing machine.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 49,
            'images' => [
                'https://down-id.img.susercontent.com/file/a28ebbfa765502970b7bf2171f0f6f96',
                'https://down-id.img.susercontent.com/file/78d35796acee495177b53418c2ee85e0',
                'https://down-id.img.susercontent.com/file/sg-11134201-22110-xh02x8i76qjvd4',
            ]
        ],
        [
            'name' => 'Fossil Stainless Steel Watch',
            'sku' => 'BQ3497',
            'category_id' => 5,
            'description' => 'This watch, which measures 3.6 cm in diameter, is equipped with a multi-colored dial with a crystal-accented bezel, analog movement and a rose gold stainless steel strap.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 239,
            'images' => [
                'https://i.ebayimg.com/images/g/xasAAOSwd-FhlwJL/s-l640.jpg',
                'https://dynamic.zacdn.com/ynDrfRC8kXVU1my0uPMXkOnTI_A=/fit-in/346x500/filters:quality(90):fill(ffffff)/https://static-id.zacdn.com/p/fossil-9940-0185732-1.jpg',
                'https://cf.shopee.co.th/file/527df00169f44277f885278c29539912',
            ]
        ],
        [
            'name' => 'X Urband Absolute Leather Viena Jaket',
            'sku' => 'XBA29234_DA',
            'category_id' => 8,
            'description' => 'X Urband Absolute Official Shop is the official account of X Urband Absolute on the Shopee platform.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/43fdcfa21810e77637a0a34e65c8d4c0',
                'https://down-id.img.susercontent.com/file/f20fc5c376002a169389409c28264ba4',
                'https://down-id.img.susercontent.com/file/388256c20a8f3e68040e238a1b60d72d',
                'https://down-id.img.susercontent.com/file/7c25301ce1a66a420d607d955e94a34d',
                'https://down-id.img.susercontent.com/file/d3e0b50c05ba1202641205c16158174c',
            ],
            'stock' => [
                [
                    'name' => 'BLACK-M',
                    'quantity' => 10000,
                    'price' => 12.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'BLACK-L',
                    'quantity' => 10000,
                    'price' => 13.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'BLACK-XL',
                    'quantity' => 10000,
                    'price' => 14.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'BLACK-XXL',
                    'quantity' => 10000,
                    'price' => 16.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'BLACKA306-M',
                    'quantity' => 10000,
                    'price' => 22.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'BLACKA306-XL',
                    'quantity' => 10000,
                    'price' => 26.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'BLACKA306-XXL',
                    'quantity' => 10000,
                    'price' => 28.99,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'Yonex Badminton Bag Racket Original',
            'sku' => 'YNBR329847_KS',
            'category_id' => 4,
            'description' => 'Step up to the power of 2nd generation RTX with GeForce RTX™ 3050 laptop family.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/54aa105844d501385f007ae8b0a0dc3a',
                'https://down-id.img.susercontent.com/file/bee0740f783a9258c33592e025fe3772',
                'https://down-id.img.susercontent.com/file/60055c111dae004473403f113ea981ff',
            ],
            'stock' => [
                [
                    'name' => 'Black',
                    'quantity' => 10000,
                    'price' => 109.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Red',
                    'quantity' => 10000,
                    'price' => 109.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Dark Blue',
                    'quantity' => 10000,
                    'price' => 109.99,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'EIGER CORE 15 LAPTOP BACKPACK',
            'sku' => 'EGR834234',
            'category_id' => 4,
            'description' => 'Core 15 is a backpack designed for everyday activities. The main compartment of this bag is equipped with a padded pocket that can fit a 14” laptop, and has enough space to store other personal equipment. The front pocket can be used to store frequently accessed items, and is equipped with a key chain. Two pockets on the side can be used to carry drinking bottles.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/id-11134207-7qul1-lfjcmjrpeh1iff',
                'https://down-id.img.susercontent.com/file/756053d69802297a0cc75dfe51f64ae2',
                'https://down-id.img.susercontent.com/file/id-11134207-7qul5-lfjcmjrpd2h2d8',
            ],
            'stock' => [
                [
                    'name' => 'Black',
                    'quantity' => 10000,
                    'price' => 36,
                    'state' => 'active',
                ],
                [
                    'name' => 'White',
                    'quantity' => 10000,
                    'price' => 36,
                    'state' => 'active',
                ],
                [
                    'name' => 'Navy',
                    'quantity' => 10000,
                    'price' => 36,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'Bodypack Seattle 1.0 Laptop Backpack - Black 21L',
            'sku' => 'BDP3424_43F',
            'category_id' => 4,
            'description' => 'Seattle 1.0 is a backpack that is suitable for use to school, campus, or everyday. This bag also comes with a different look through the roll top model design. To support your activities, Seattle 1.0 provides a main compartment for storing luggage including a 14 inch laptop and 10 inch tablet, as well as one front pocket and two side pockets for additional items.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 63,
            'images' => [
                'https://down-id.img.susercontent.com/file/sg-11134201-23020-j0rnwj4ubanv39',
                'https://down-id.img.susercontent.com/file/sg-11134201-23020-wz3px74ubanva3',
                'https://down-id.img.susercontent.com/file/sg-11134201-23020-ctsxn24ubanvb7',
                'https://down-id.img.susercontent.com/file/sg-11134201-23020-c3skja5ubanvb3',
            ]
        ],
        [
            'name' => 'Exsport Weekender Rucksack - Cream',
            'sku' => 'EWRKSC2348',
            'category_id' => 4,
            'description' => 'The Weekender Rucksack is a backpack for those of you who like to explore. Designed to be light and handy with an adjustable strap, and enjoy large storage space.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 59.80,
            'images' => [
                'https://down-id.img.susercontent.com/file/5f4e56a3e94ada74ac164d8263df78f9',
                'https://down-id.img.susercontent.com/file/a8014766a9dc2783bb1aa0a389af10fe',
                'https://down-id.img.susercontent.com/file/02f9dd8fa36b5d9f15953a9baa197a31',
                'https://down-id.img.susercontent.com/file/4892cc609d4f2254bd757895377ace52',
            ]
        ],
        [
            'name' => 'Hush Puppies Womens Bag',
            'sku' => 'HSHPPP2342',
            'category_id' => 4,
            'description' => 'Bag with main compartment using magnet, additional 1 small pocket on the front and 2 small pockets on the inside, strong canvas material, and embroidered design on the front, equipped with a strap.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 49.70,
            'images' => [
                'https://down-id.img.susercontent.com/file/f4e72c4e9f047823f01806829c8fc9bd',
                'https://down-id.img.susercontent.com/file/00eed5a27f527b79fb717393a4f347aa',
                'https://down-id.img.susercontent.com/file/4844a791e2343dd0db4d985ca44826f4',
            ]
        ],
        [
            'name' => 'Fjallraven Kanken Backpack - Fog-Pink',
            'sku' => 'FJK234BH',
            'category_id' => 4,
            'description' => 'Kanken Bag was released way back in 1978 to prevent spinal problems among Swedish school students and was widely used so that it became a trend among school students.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 179.99,
            'images' => [
                'https://down-id.img.susercontent.com/file/5236ed31ae10762d2567c6b8a7306f17',
                'https://down-id.img.susercontent.com/file/8aa2c9465619683c33393cb57535b661',
                'https://down-id.img.susercontent.com/file/a1e890280e130066509d79fe13f69e42',
            ]
        ],
        [
            'name' => 'PLAYNOMORE Womens Elegant Bag',
            'sku' => 'PLMELBG453',
            'category_id' => 4,
            'description' => 'PLAYNOMORE is all about having fun with fashion.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/37b6c388d9c2a70dbb98355ba9758939',
                'https://down-id.img.susercontent.com/file/e7f2ea380f11b1fe96b81d2045b8b20e',
                'https://down-id.img.susercontent.com/file/42c33c7cb6786e9f41c876fc7fe86c10',
                'https://down-id.img.susercontent.com/file/2c9f2da7f163e0c1794c15cc45767e39',
            ],
            'stock' => [
                [
                    'name' => 'Micro Candy White',
                    'quantity' => 10000,
                    'price' => 159.60,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'Gobelini Pasadena Flap Top Handle Bag',
            'sku' => 'GBLNPSF3242',
            'category_id' => 4,
            'description' => 'Top Handle Bag with Material Genuine Leather, Fabric Inner Lining,Inside with Two Main Compartment with Lock and One Main Compartment with Zipper, Compactible with One Pocket Slevee and One Gadget Pocket, Adjustable & Detachable Shoulder Straps.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 85.99,
            'images' => [
                'https://down-id.img.susercontent.com/file/sg-11134201-22120-q5qlm7bpjzkv0a',
                'https://down-id.img.susercontent.com/file/sg-11134201-22120-b42jfpjpjzkva1',
                'https://down-id.img.susercontent.com/file/sg-11134201-22110-of7bj81431jv34',
            ]
        ],
        [
            'name' => 'ESQA Goddess Eyeshadow Palette - Steel',
            'sku' => 'ESQKF4935',
            'category_id' => 6,
            'description' => 'Steal the show with our ESQA Steel Goddess Eyeshadow Palette! This palette has complete range of cool-toned monochromatic shades with superstar touch of silver sparkles.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 16.99,
            'images' => [
                'https://down-id.img.susercontent.com/file/id-11134207-7qul6-lf7py8ajosdp18',
                'https://down-id.img.susercontent.com/file/id-11134207-7quky-lf7py8ajvt7xb1',
                'https://down-id.img.susercontent.com/file/id-11134207-7qul5-lfidigqr187af5',
            ]
        ],
        [
            'name' => 'PUMA Caracal Sneakers',
            'sku' => 'PUMACRSN324',
            'category_id' => 3,
            'description' => 'Long, clean lines, a premium leather upper, and a tennis-inspired silhouette make the Caracal Sneaker your go-to style, both on and off the court.',
            'state' => 'active',
            'quantity' => 10000,
            'price' => 98.99,
            'images' => [
                'https://down-id.img.susercontent.com/file/id-11134201-23020-ftnov3kq61nv7d',
                'https://down-id.img.susercontent.com/file/id-11134201-23020-d3wej0kq61nvad',
                'https://down-id.img.susercontent.com/file/id-11134201-23020-83wej0kq61nvbd',
            ]
        ],
        [
            'name' => 'EIGER C.RIPS C089 PANTS - BLACK',
            'sku' => 'EGRCBLCK2342',
            'category_id' => 7,
            'description' => 'Designed for outdoor enthusiasts, the Rips 089 technical pants are equipped with several technical features that can support their role as outdoor pants. Rips 089 is made of polyrayon material which is comfortable for activities.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/7eceb96af9d8e0dc5cf122eb0b5dabea',
                'https://down-id.img.susercontent.com/file/24bae251467c872f1d15edac2f0768c7',
                'https://down-id.img.susercontent.com/file/ce43ee12ca54ce03101b5e188b1ac77c',
                'https://down-id.img.susercontent.com/file/2fdfa2f46c0ff74eda25689a0d361aa0',
            ],
            'stock' => [
                [
                    'name' => '29',
                    'quantity' => 10000,
                    'price' => 35.99,
                    'state' => 'active',
                ],
                [
                    'name' => '30',
                    'quantity' => 10000,
                    'price' => 35.99,
                    'state' => 'active',
                ],
                [
                    'name' => '31',
                    'quantity' => 10000,
                    'price' => 35.99,
                    'state' => 'active',
                ],
                [
                    'name' => '32',
                    'quantity' => 10000,
                    'price' => 35.99,
                    'state' => 'active',
                ],
                [
                    'name' => '34',
                    'quantity' => 10000,
                    'price' => 38.99,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'CHRONOX Mens Analog Leather Watch',
            'sku' => 'CRX32354K',
            'category_id' => 5,
            'description' => 'Chronox main goal is to bring out everyones potential through fashion. We want people to understand more about themselves through the products that Chronox presents, by presenting the best quality with maximum functionality and comfort.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/9cb92294b8f3b4c64cae53e3c864259b',
                'https://down-id.img.susercontent.com/file/f92b76b4b1a119507e65dca6110a334f',
                'https://down-id.img.susercontent.com/file/4bbe4e351efea674dfe0d367e943ea4b',
                'https://down-id.img.susercontent.com/file/8623d7f8a5bf580a5543b77961fa150d',
            ],
            'stock' => [
                [
                    'name' => 'Black Rosegold',
                    'quantity' => 10000,
                    'price' => 82.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'White Rosegold',
                    'quantity' => 10000,
                    'price' => 82.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Brown',
                    'quantity' => 10000,
                    'price' => 82.99,
                    'state' => 'active',
                ],
            ]
        ],
        [
            'name' => 'Hikemore Mens Quick Dry Shorts Mountain Hiking Flywheel Reg',
            'sku' => 'HKM453544_JFD',
            'category_id' => 7,
            'description' => 'Chronox main goal is to bring out everyones potential through fashion. We want people to understand more about themselves through the products that Chronox presents, by presenting the best quality with maximum functionality and comfort.',
            'state' => 'active',
            'images' => [
                'https://down-id.img.susercontent.com/file/id-11134201-23030-8g8j83emc9nv6f',
                'https://down-id.img.susercontent.com/file/id-11134201-23030-jjuatgnmc9nv82',
                'https://down-id.img.susercontent.com/file/id-11134201-23030-apicwjjnc9nvdd',
            ],
            'stock' => [
                [
                    'name' => 'Black',
                    'quantity' => 10000,
                    'price' => 15.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Navy',
                    'quantity' => 10000,
                    'price' => 15.99,
                    'state' => 'active',
                ],
                [
                    'name' => 'Dark Grey',
                    'quantity' => 10000,
                    'price' => 15.99,
                    'state' => 'active',
                ],
            ]
        ],
    ];
}
