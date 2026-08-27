<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected array $details = [
        '先日注文した商品がまだ届いていません。配送状況を確認していただけますでしょうか。',
        '購入した商品のサイズが合わなかったため、交換をお願いしたいです。手続きを教えてください。',
        '届いた商品に傷があり、不良品のようです。対応をお願いいたします。',
        '会員登録の方法が分からないので、詳しく教えていただけますか。',
        '注文をキャンセルしたいのですが、手続き方法を教えてください。',
        '支払い方法を変更したいのですが、可能でしょうか。',
        '商品の在庫状況について確認したいです。よろしくお願いいたします。',
        '返品したい商品があるのですが、送料はどちらの負担になりますか。',
        'クーポンコードが使用できなかったため、確認をお願いします。',
        'ホームページの営業時間の記載が実際と異なっているようです。ご確認をお願いします。',
    ];

    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1, 5),
            'first_name' => fake()->lastName(),
            'last_name' => fake()->firstName(),
            'gender' => fake()->numberBetween(1, 3),
            'email' => fake()->safeEmail(),
            'tel' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'building' => fake()->secondaryAddress(),
            'detail' => fake()->randomElement($this->details),
        ];
    }
}
