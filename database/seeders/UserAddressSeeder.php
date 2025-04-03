<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\UserAddress;
use App\Models\User;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $user = User::inRandomOrder()->first();
            $date = $faker->dateTimeThisYear;
            $endDate = $faker->dateTimeInInterval($date, '+2 month');
            $cityData = [
                'Hà Nội' => [
                    'districts' => ['Ba Đình', 'Hoàn Kiếm', 'Đống Đa', 'Cầu Giấy', 'Tây Hồ', 'Long Biên'],
                    'address_details' => [
                        '123 phố X, quận Ba Đình',
                        '45 phố Y, quận Hoàn Kiếm',
                        '67 phố Z, quận Đống Đa',
                        '89 phố A, quận Cầu Giấy',
                        '12 đường B, quận Tây Hồ',
                        '56 đường C, quận Long Biên'
                    ]
                ],
                'Hồ Chí Minh' => [
                    'districts' => ['Quận 1', 'Quận 3', 'Quận 5', 'Quận 7', 'Quận 10', 'Quận Bình Thạnh'],
                    'address_details' => [
                        '123 đường B, Quận 1',
                        '45 đường C, Quận 3',
                        '67 đường D, Quận 5',
                        '89 đường E, Quận 7',
                        '23 đường F, Quận 10',
                        '78 đường G, Quận Bình Thạnh'
                    ]
                ],
                'Đà Nẵng' => [
                    'districts' => ['Sơn Trà', 'Liên Chiểu', 'Cẩm Lệ', 'Hải Châu', 'Ngũ Hành Sơn'],
                    'address_details' => [
                        '123 đường H, Sơn Trà',
                        '45 đường G, Liên Chiểu',
                        '67 đường F, Cẩm Lệ',
                        '89 đường E, Hải Châu',
                        '34 đường D, Ngũ Hành Sơn'
                    ]
                ],
                'Hải Phòng' => [
                    'districts' => ['Lê Chân', 'Ngô Quyền', 'Kiến An', 'Hồng Bàng', 'Đồ Sơn'],
                    'address_details' => [
                        '123 đường X, Lê Chân',
                        '45 đường W, Ngô Quyền',
                        '67 đường V, Kiến An',
                        '89 đường U, Hồng Bàng',
                        '56 đường T, Đồ Sơn'
                    ]
                ],
                'Cần Thơ' => [
                    'districts' => ['Ninh Kiều', 'Cái Răng', 'Bình Thủy', 'Ô Môn', 'Phong Điền'],
                    'address_details' => [
                        '123 đường L, Ninh Kiều',
                        '45 đường M, Cái Răng',
                        '67 đường N, Bình Thủy',
                        '89 đường O, Ô Môn',
                        '12 đường P, Phong Điền'
                    ]
                ],
                'Huế' => [
                    'districts' => ['Hương Thủy', 'Hương Trà', 'Phú Vang', 'Quảng Điền', 'Thị xã Hương Cần'],
                    'address_details' => [
                        '123 đường Q, Hương Thủy',
                        '45 đường R, Hương Trà',
                        '67 đường S, Phú Vang',
                        '89 đường T, Quảng Điền',
                        '23 đường U, Hương Cần'
                    ]
                ],
                'Nha Trang' => [
                    'districts' => ['Nha Trang', 'Cam Lâm', 'Vạn Ninh', 'Khánh Vĩnh', 'Diên Khánh'],
                    'address_details' => [
                        '123 đường V, Nha Trang',
                        '45 đường W, Cam Lâm',
                        '67 đường X, Vạn Ninh',
                        '89 đường Y, Khánh Vĩnh',
                        '12 đường Z, Diên Khánh'
                    ]
                ],
                'Bắc Ninh' => [
                    'districts' => ['Bắc Ninh', 'Từ Sơn', 'Quế Võ', 'Yên Phong', 'Gia Bình'],
                    'address_details' => [
                        '123 đường A, Bắc Ninh',
                        '45 đường B, Từ Sơn',
                        '67 đường C, Quế Võ',
                        '89 đường D, Yên Phong',
                        '23 đường E, Gia Bình'
                    ]
                ],
                'Quảng Ninh' => [
                    'districts' => ['Hạ Long', 'Móng Cái', 'Cẩm Phả', 'Uông Bí', 'Vân Đồn'],
                    'address_details' => [
                        '123 đường F, Hạ Long',
                        '45 đường G, Móng Cái',
                        '67 đường H, Cẩm Phả',
                        '89 đường I, Uông Bí',
                        '12 đường J, Vân Đồn'
                    ]
                ],
            ];

            $randomCity = array_rand($cityData);
            $randomDistrict = $cityData[$randomCity]['districts'][array_rand($cityData[$randomCity]['districts'])];
            $randomAddressDetail = $cityData[$randomCity]['address_details'][array_rand($cityData[$randomCity]['address_details'])];

            $lat = $faker->latitude($min = -90, $max = 90);
            $long = $faker->longitude($min = -180, $max = 180);
            $lable = ['Office', 'Home'];
            $userAddress = UserAddress::where('user_id', $user->id)->first();
            if (!$userAddress) {
                $data[] = [
                    "name" => $user->name,
                    "lable_as" => $lable[array_rand($lable)],
                    "country" => 'Việt Nam',
                    "city" => $randomCity,
                    "district" => $randomDistrict,
                    "address_detail" => $randomAddressDetail,
                    "lat" => '20.670335983347613',
                    "long" => '105.77808140804346',
                    "phone" => $user->phone,
                    "user_id" => $user->id,
                ];
            }

            if ($i % 10 == 0) {
                UserAddress::insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            UserAddress::insert($data);
        }
    }
}
