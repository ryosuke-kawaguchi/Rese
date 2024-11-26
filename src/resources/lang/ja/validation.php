<?php

return [
    'required' => ':attributeは必須項目です。',
    'email' => ':attributeには有効なメールアドレスを入力してください。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],
    'confirmed' => ':attributeが確認用と一致しません。',
    'attributes' => [
        'name' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],
];