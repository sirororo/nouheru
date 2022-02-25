<!-- omit in toc -->
# 農へる


<br>

 **農業を盛り上げるためのSNSアプリです。**

 このアプリのコンセプトは、以下の３つです。
 - 利用者は **口コミや評価** を参考に **自分に合ったサービス** を選択することができます。
 - サービス提供者同士が競争することで **品質の向上** に繋げることができます。
 - サービス内容を簡単に他社と比較できるので **ぼったくりを抑止** できます。

**URL：**[農へる](http://handson-874214957.ap-northeast-1.elb.amazonaws.com/kiso/shop/index.php)

![***代替テキスト***](https://github.com/sirororo/nouheru/blob/master/diagram/top.pdf)

<img src="https://github.com/sirororo/nouheru/blob/master/diagram/top.pdf" >


```text
  ログインをしなくても閲覧は可能です。
  会員登録を省略したい場合は以下の業者リストからログインしてください。

  １）農機具レンタル業者： 狩生 岳志
  ・メールアドレス： 
  ・パスワード： 

  ２）専門の経理・会計：小林 陽介
  ・メールアドレス：
  ・パスワード： 

  ３）無料サービス：横山 豊
  ・メールアドレス：
  ・パスワード： 

```


<br>
## 2. 目次

- [1. アプリの概要](#1-アプリの概要)
- [2. 目次](#2-目次)
- [3. 主な利用シーン](#3-主な利用シーン)
- [4. 機能一蘭](#4-機能一蘭)
- [5. 操作手順書](#5-操作手順書)
  - [5.1. 依頼の手順](#51-依頼の手順)
    - [5.1.1. ログイン[想定作業時間：２分]](#511-ログイン想定作業時間２分)
    - [5.1.2. サービスの依頼をする[想定作業時間：２分]](#512-サービスの依頼をする想定作業時間２分)
    - [5.1.3. 依頼しているリストを確認する[想定作業時間：１分]](#513-依頼しているリストを確認する想定作業時間１分)
    - [5.1.4. 依頼完了の手続きをする[想定作業時間：１分]](#514-依頼完了の手続きをする想定作業時間１分)
  - [5.2. サービス登録と受注の手順](#52-サービス登録と受注の手順)
    - [5.2.1. サービスの登録をする[想定作業時間：２分]](#521-サービスの登録をする想定作業時間２分)
    - [5.2.2. 受注内容を確認する[想定作業時間：１分]](#522-受注内容を確認する想定作業時間１分)
- [6. セキュリティーや負荷分散について](#6-セキュリティーや負荷分散について)
  - [6.1. PHP](#61-php)
  - [6.2. AWS](#62-aws)
- [7. 苦労した点](#7-苦労した点)
- [9. 今後の課題](#9-今後の課題)
- [8. 資料](#8-資料)
  - [8.1. 画像資料](#81-画像資料)
  - [8.2. 参考教材](#82-参考教材)
  - [セキュリティ教材](#セキュリティ教材)
- [14. 使用言語](#14-使用言語)
- [10. DB設計](#10-db設計)
- [11. 各テーブルについて](#11-各テーブルについて)

<br>

---
## 3. 主な利用シーン
- 「農機具を購入したいが高額で手が出せない・・・」 <br>→　　他の農家から**レンタル**することで、**購入コスト**と**保管場所のコスト**を抑えることができる



```text
   例）田植機を１日レンタルする
```



<br>

- 「最新の農機具を使ってみたいが高額で種類も多くてわからない・・・」<br>→　　**無料サービス**で実際に体験ができ、気に入れば**そのまま購入**もできる
```text
   例）ドローンを無料体験してみる
```

<br>

- 「農業法人の設立したいがわからない・・・」<br>→　　**農業専門の行政書士**が代行してくれる
```text
   例）めんどくさい農業に関する起業の手続きを代行してもらえる
```

<br>

- 「売上と書類管理に手間がかかり農業に専念できない・・・」<br>→　　月額費を払えばデータ管理を**クラウドで管理**し、**業務の手間を大幅に削減**できる
```text
   例）生産や販売管理をデータ化して可視化することで常に状況を簡単に確認できる
```

<br>

- 「農業を始めたいが初期費用として栽培システムの設置が高額すぎて手が出せない・・・」<br> →　　**月額制のレンタル**から始めて、**一定期間利用**して頂ければ**そのままもらえる**
```text
   例）ビニールハウスと水耕栽培装置セットで月額16,9800円でレンタルできる（１２ヶ月利用でそのまま引き取れる）
```

<br>

---

## 4. 機能一蘭

- **データを可視化して売上の表示**（管理者側）

```text

  ・手数料売上

  ・取引金額累計

  ・平均取引金額

  ・取引履歴
```

  <br>

- **サービス利用関連**

```text
  ・サービスの登録・修正

  ・サービスの依頼

  ・サービスの口コミと評価
```

<br>


- **ユーザー登録関連**

```text
  ・ユーザーの登録・修正

  ・ログイン・ログアウト
```

<br>


---

## 5. 操作手順書

### 5.1. 依頼の手順

#### 5.1.1. ログイン[想定作業時間：２分]

- [x] [農へる](http://handson-874214957.ap-northeast-1.elb.amazonaws.com/kiso/shop/index.php)にアクセス<br><br>

```text
  ログイン登録を省略したい場合は以下の業者リストからログインしてください。

  １）農機具レンタル業者： 狩生 岳志
  ・メールアドレス： 
  ・パスワード： 

  ２）専門の経理・会計：小林 陽介
  ・メールアドレス：
  ・パスワード： 

  ３）無料サービス：横山 豊
  ・メールアドレス：
  ・パスワード： 

```


- [x] トップ画面の右上の`無料会員登録`をクリック<br><br>
- [x] `名前`・`メールアドレス`・`郵便番号`・`住所`・`電話番号`・`パスワード`・`性別`・`生まれ年`・`顔写真`を記入後`確認して進む`をクリック<br><br>

 - [x] 会員情報の再確認後`確認して進む`をクリック<br><br>
 - [x] 登録完了後`トップへ移動する`をクリック<br><br>

<br>

#### 5.1.2. サービスの依頼をする[想定作業時間：２分]

- [x] トップ画面のカテゴリ一覧からサービスを選び`内容を確認する`をクリック<br><br>
- [x] サービス内容と口コミを確認後`無料相談をする`をクリック<br><br>
- [x] `作業内容`・`作業日付`・`作業場所の郵便番号`・`作業場所の住所`を記入後`確認して進む`をクリック<br><br>
- [x] 依頼内容を再確認後`登録する`をクリック<br><br>
- [x] 依頼内容を送信後は`依頼中リストで確認`か左上の`マイページ`で確認できます<br><br>

<br>

#### 5.1.3. 依頼しているリストを確認する[想定作業時間：１分]

- [x] 左上の`マイページ`をクリック<br><br>
- [x] `依頼中のリスト`をクリック<br><br>
- [x] 依頼画面が出るため`内容を確認する`をクリック<br><br>
- [x] サービス内容と依頼内容が確認できます<br><br>

<br>

#### 5.1.4. 依頼完了の手続きをする[想定作業時間：１分]

- [x] `依頼中のリスト`の`依頼完了の手続きに進む`をクリック<br><br>
- [x] `満足度`・`金額`・`感想`を記入後`確認して進む`をクリック<br><br>
- [x] 内容を再確認後`登録する`をクリック<br><br>
- [x] 登録完了後は依頼したサービスに口コミや`運用管理データ`に金額が反映されるようになります<br><br>

<br>

### 5.2. サービス登録と受注の手順
（ログイン状態であることを前提にしています）

#### 5.2.1. サービスの登録をする[想定作業時間：２分]

- [x] トップ画面の左上にある`マイページ`をクリック<br><br>
- [x] `サービス設定`の`確認をする`をクリック<br><br>
- [x] `自分のサービスを掲載する`の`記入へ進む`をクリック<br><br>
- [x] `業種`・`プロフィール`・`サービス内容`・`価格`・`営業時間`・`対応地域`・`支払い方法`・`作業画像`を記入して`確認して進む`をクリック<br><br>
- [x] 登録画面を再確認後`登録する`をクリック<br><br>
- [x] 登録確認後に仕事の依頼が来た場合はメールでお知らせしてくれます。依頼内容は`受注リスト`で確認できます<br><br>

<br>
#### 5.2.2. 受注内容を確認する[想定作業時間：１分]

- [x] トップ画面の左上にある`マイページ`をクリック<br><br>
- [x] `受注中のリスト`の`確認をする`をクリック<br><br>
- [x] 顧客から依頼が来ているので`内容を確認する`をクリック<br><br>
- [x] 依頼内容が確認できます<br><br>

<br>

---
## 6. セキュリティーや負荷分散について

### 6.1. PHP

- [x] ファイルアップロード時の**ファイル名をランダム化**<br><br>
- [x] 画像ファイルは予め画像ファイルしか選択できないように<br><br>
- [x] 画像ファイルアップロード時には予め**指定した拡張子以外はエラー**表示<br><br>
- [x] 画像ファイルには**実行権限を与えない**ように変更<br><br>
- [x] **ログインに３回以上失敗**するとエラー表示させログインできないように<br><br>
- [x] **CSRF対策**としてデータ登録のページには**ワンタイムトークン**を使用してエラー表示させます。<br><br>
- [x] **XSS対策**としてすべて入力したものは**htmlspecialchars関数**を使いサニタイジング<br><br>
- [x] **入力フィルタ**では**正規表現**でデータ（電話番号、メールアドレスなど）を確認<br><br>
- [x] 入力データ（サービス登録時）に「http」を含めるとエラー表示されます。<br><br>

<br>

### 6.2. AWS

- [x] パブリックサブネットへ**SSH接続**する際の設定は**マイIPのみでアクセス**するように<br><br>
- [x] パスワードログインでは危険なのでルートアカウントの**MFAを有効化**<br><br>
- [x] 外部から直接アクセスできないようにRDSはプライベートサブネットに設置<br><br>
- [x] DNSサーバーのドメイン登録の際は、プライバシーの保護を有効化に<br><br>
- [x] 可用性と耐障害性を持たせるため**複数のAZにサブネットを設置**<br><br>
- [x] 可用性と負荷分散を持たせるために**サブネットグループを三層**に分けます<br><br>
- [x] SSL証明書を作成し**HTTPSを有効化**<br><br>
- [x] EC2の**EBS**を**KMSで暗号化**<br><br>
- [x] RDSを**KMSで暗号化**<br><br>


---
## 7. 苦労した点

- EC２インスタンスに**EBS**をアタッチして**再起動してもデバイス同士でパスが通っている**状態を維持すること

<br>

- **２ホップSSHトンネル**を使ってローカル環境から直接RDSにアクセスすること（キーペアのコピーを一時的にパブリックサブネットに置く方法）

<br>

- SSM Rum Commandを実行して複数のEC2インスタンスをリモート操作すること

<br>

- Dockerを構築すること

<br>


---
## 9. 今後の課題

・**１次情報を理解できるほどの知識を習得する。**
セキュリティやインフラなど**重要な情報**は、理解しやすい教材など**２次情報**から学ぶことが多いため、
今後は**資格取得や公式ドキュメントから知識を得るようにします。**

<br>

・**terraformを使いこなせるようにする。**
今はterraformで**EC2やS3**などを１つずつ構築するような簡単なことしかできないため、
**実践レベルまで技術を上げていきます。**

---
## 8. 資料

### 8.1. 画像資料

- [photoAC](https://www.photo-ac.com/)
- [ぱくたそ](https://www.pakutaso.com/)
- [揖斐川工業株式会社](https://www.ibiko.co.jp/)

### 8.2. 参考教材

- [CS Career Kaizen University](https://www.cscareerkaizen.com/about)
- [気づけばプロ並みPHP 改訂版](https://www.ric.co.jp/book/programming/detail/192)
- [HTML、CSS をマスター](https://www.udemy.com/course/html5css3-b/)
- [フロントエンドウェブ開発をBootstrap Vueでスタート!!](https://www.udemy.com/course/tanakatakashi-01bootstrapvue/)

### セキュリティ教材

- [本当は怖いファイルアップロード攻撃](https://at-virtual.net/securecoding/%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%A2%E3%83%83%E3%83%97%E3%83%AD%E3%83%BC%E3%83%89%E6%94%BB%E6%92%83%E3%81%AE%E7%90%86%E8%A7%A3%E3%81%A8%E4%BF%AE%E6%AD%A3%E6%96%B9%E6%B3%95/)
- [PHPセキュリティー](https://wepicks.net/category/phpsecurity/)

<br>




## 14. 使用言語

- フロントエンド
  - Bootstrapーvue
  - javascript
  - HTML/CSS

<br>

- バックエンド
  - PHP

<br>

- インフラ
  - AWS（EC2,EBS,KMS,S3,snapshot,SSM,ACM,RDS DB,VPC,ALB,）
  - Docker
  - nginx
  - mysql

<br>


## 10. DB設計

<br>

## 11. 各テーブルについて

| No   | 氏名            |
| ----: | --------------- |
| 1    | 侍エンジニア1  |
| 2    | 侍エンジニア2 |
| 3    | 侍エンジニア3 |
| 4    | 侍エンジニア4   |


<br>





