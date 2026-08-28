<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.7;">
    <p>{{ $contact->first_name }} {{ $contact->last_name }} 様</p>

    <p>この度はお問い合わせいただき、誠にありがとうございます。<br>
    以下の内容で受け付けいたしました。担当者より改めてご連絡いたします。</p>

    <table style="border-collapse: collapse; margin: 20px 0;">
        <tr>
            <th style="text-align: left; padding: 6px 16px 6px 0; color: #96814a;">お名前</th>
            <td style="padding: 6px 0;">{{ $contact->first_name }} {{ $contact->last_name }}</td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 6px 16px 6px 0; color: #96814a;">メールアドレス</th>
            <td style="padding: 6px 0;">{{ $contact->email }}</td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 6px 16px 6px 0; color: #96814a;">電話番号</th>
            <td style="padding: 6px 0;">{{ $contact->tel }}</td>
        </tr>
        <tr>
            <th style="text-align: left; padding: 6px 16px 6px 0; color: #96814a;">お問い合わせ内容</th>
            <td style="padding: 6px 0;">{{ $contact->detail }}</td>
        </tr>
    </table>

    <p style="font-size: 13px; color: #888;">
        ※このメールにお心当たりがない場合は、大変お手数ですが本メールを破棄くださいますようお願いいたします。
    </p>

    <p>form-craft</p>
</body>
</html>
