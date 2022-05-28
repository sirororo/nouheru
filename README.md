
<br>

【サービスの概要】
農家の生活を楽にするために、主に以下のサービスを受けられる

✔ 農家の業務を委託できる

✔ 農機具を農家同士でシェアする

✔ 農機具を購入する前に、無料で一度体験をすることができる

<br>

**URL：**[サービス内容](https://qiita.com/sirororo/items/a9e121983e73fb4b4805)

**URL：**[操作手順書](https://qiita.com/sirororo/items/d6ab481eee2c2a187cdb)

**URL：**[アプリ](http://handson-874214957.ap-northeast-1.elb.amazonaws.com/kiso/shop/index.php)

**URL：**[github](https://github.com/sirororo/nouheru)






![トップ１](https://github.com/sirororo/nouheru/blob/master/diagram/top1.png?raw=true)

![トップ２](https://github.com/sirororo/nouheru/blob/master/diagram/top2.png?raw=true)


【農家のメリット】

✔ サービスの**口コミ**や**評価**を参考にできる

✔ 農機具の**レンタル**をすることで**費用を抑える**ことができる

✔ 高額な**農機具購入する前**に「**無料サービス**」を使うことで自分に合った物か確認できる

【サービス提供者のメリット】

✔ 使っていない農機具を**他の農家に貸す**ことで**利益を得られる**（CtoC）

✔ 口コミや評価によって**業務改善**につながる

✔ 「無料サービス」の利用から**高額な農機具の販売に繋げられる**（DtoC）




<br>



```text
  ログインをしなくても閲覧は可能です。
  会員登録を省略したい場合は以下の業者リストからログインしてください。

  １）農機具レンタル業者： 狩生 岳志
  ・メールアドレス： rrrr@gmail.com
  ・パスワード： rrrr

  ２）専門の経理・会計：小林 陽介
  ・メールアドレス：2222@gmail.com 
  ・パスワード： 2222

  ３）無料サービス：横山 豊
  ・メールアドレス：6666@gmail.com
  ・パスワード： 6666

```


<br>


- [1. 目次](#1-目次)
- [2. 主な利用シーン](#2-主な利用シーン)
- [3. 機能一蘭](#3-機能一蘭)
- [4. セキュリティーや負荷分散について](#4-セキュリティーや負荷分散について)
  - [4.1. PHP](#41-php)
  - [4.2. AWS](#42-aws)
- [5. 苦労した点](#5-苦労した点)
- [6. 今後の課題](#6-今後の課題)
- [7. 使用言語](#7-使用言語)
- [8. 資料](#8-資料)
  - [8.1. 画像資料](#81-画像資料)
  - [8.2. 参考教材](#82-参考教材)
  - [8.3. セキュリティ教材](#83-セキュリティ教材)


## 1. 目次



<br>

---
## 2. 主な利用シーン
  「農機具を購入したいが高額で手が出せない・・・」 <br>→　　他の農家から**レンタル**することで、**購入コスト**と**保管場所のコスト**を抑えることができる

<img src="https://github.com/sirororo/nouheru/blob/master/diagram/noukigu1.jpg?raw=true" alt="農機具" width="500">

```text
   例）田植機を１日レンタルする
```



<br><br>

 「最新の農機具を使ってみたいが高額で種類も多くてわからない・・・」<br>→　　**無料サービス**で実際に体験ができ、気に入れば**そのまま購入**もできる

<img src="https://github.com/sirororo/nouheru/blob/master/diagram/doron.jpg?raw=true" alt="ドローン" width="500">


```text
   例）ドローンを無料体験してみる
```

<br><br>

 「農業法人の設立したいがわからない・・・」<br>→　　**農業専門の行政書士**が代行してくれる

<img src="https://github.com/sirororo/nouheru/blob/master/diagram/keiri2.jpg?raw=true" alt="行政書士" width="500">

```text
   例）めんどくさい農業に関する起業の手続きを代行してもらえる
```

<br><br>

 「売上と書類管理に手間がかかり農業に専念できない・・・」<br>→　　月額費を払えばデータ管理を**クラウドで管理**し、**業務の手間を大幅に削減**できる

<img src="https://github.com/sirororo/nouheru/blob/master/diagram/it.jpg?raw=true" alt="インフラ" width="500">

```text
   例）生産や販売管理をデータ化して可視化することで常に状況を簡単に確認できる
```

<br><br>

 「農業を始めたいが初期費用として栽培システムの設置が高額すぎて手が出せない・・・」<br> →　　**月額制のレンタル**から始めて、**一定期間利用**して頂ければ**そのままもらえる**


<img src="https://github.com/sirororo/nouheru/blob/master/diagram/saibai1.jpg?raw=true" alt="インフラ" width="500">


                                                                                                             
                                                                                                             
```text
   例）ビニールハウスと水耕栽培装置セットで月額16,9800円でレンタルできる（１２ヶ月利用でそのまま引き取れる）
```

<br><br>

---

## 3. 機能一蘭

 ✔ **データを可視化して売上の表示**（管理者側）

```text

  ・手数料売上

  ・取引金額累計

  ・平均取引金額

  ・取引履歴
```

  <br><br>

✔  **サービス利用関連**

```text
  ・サービスの登録・修正

  ・サービスの依頼

  ・サービスの口コミと評価
```

<br><br>


✔  **ユーザー登録関連**

```text
  ・ユーザーの登録・修正

  ・ログイン・ログアウト
```

<br><br>


---



## 4. セキュリティーや負荷分散について

### 4.1. PHP

![エラー](https://github.com/sirororo/nouheru/blob/master/diagram/era.png?raw=true)

✔  ファイルアップロード時の**ファイル名をランダム化**<br><br>
✔ 画像ファイルは予め画像ファイルしか選択できないようにする<br><br>
✔  画像ファイルアップロード時には予め**指定した拡張子以外はエラー**表示にする<br><br>
✔  画像ファイルには**実行権限を与えない**ように変更する<br><br>
✔ **ログインに３回以上失敗**するとエラー表示させログインできないようにします<br><br>
✔ **CSRF対策**としてデータ登録のページには**ワンタイムトークン**を使用してエラー表示する<br><br>
✔ **XSS対策**としてすべて入力したものは**htmlspecialchars関数**を使いサニタイジング化<br><br>
✔ **入力フィルタ**では**正規表現**でデータ（電話番号、メールアドレスなど）を確認<br><br>
✔ 入力データ（サービス登録時）に「http」を含めるとエラー表示<br><br>
✔ パスワードは暗号化して登録

<br>

### 4.2. AWS

![AWS](https://github.com/sirororo/nouheru/blob/master/diagram/aws.png?raw=true)


![ER図](https://github.com/sirororo/nouheru/blob/master/diagram/Untitled.png?raw=true)


| テーブル名 | 説明            |
| ----: | --------------- |
|dat_member| ユーザー情報 |
| mst_product | サービス情報 |
| iraityu_sales| 依頼の内容 |
| iraityu_sales_product| 依頼内容の詳細 |
| ok_sales| 依頼完了の内容 |
| ok_sales_product| 依頼完了の詳細 |

<br>

✔  パブリックサブネットへ**SSH接続**する際の設定は**マイIPのみでアクセス**するようにする<br><br>
✔ パスワードログインでは危険なのでルートアカウントの**MFAを有効化**<br><br>
✔ 外部から直接アクセスできないようにRDSはプライベートサブネットに設置する<br><br>
✔ DNSサーバーのドメイン登録の際は、プライバシーの保護を有効化<br><br>
✔ 可用性と耐障害性を持たせるため**複数のAZにサブネットを設置**<br><br>
✔ 可用性と負荷分散を持たせるために**サブネットグループを三層**に分けます<br><br>
✔ SSL証明書を作成し**HTTPSを有効化**（ドメイン認証型）<br><br>
✔ EC2の**EBS**を**KMSで暗号化**<br><br>
✔ RDSを**KMSで暗号化**<br><br>


---


## 5. 苦労した点

✔ EC２インスタンスに**EBS**をアタッチして**再起動してもデバイス同士でパスが通っている**状態を維持すること

<br>

✔ **２ホップSSHトンネル**を使ってローカル環境から直接RDSにアクセスすること（キーペアのコピーを一時的にパブリックサブネットに置く方法）


<br>

✔ Dockerを構築すること

<br>


---
## 6. 今後の課題



✔**インフラをコード化する。**

今はterraformで**EC2やS3**などを１つずつ構築するような簡単なことしかできないため、**実践レベルまで技術を上げていきます。**

<br>

✔**セキュリティやインフラについてもっと勉強する。**

システム設計をする際はセキュリティについての知識が必須なため、まずはAWS認定セキュリティの取得を目指します。


---






## 7. 使用言語

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



<br>




## 8. 資料

### 8.1. 画像資料

- [photoAC](https://www.photo-ac.com/)
- [ぱくたそ](https://www.pakutaso.com/)


### 8.2. 参考教材

- [CS Career Kaizen University](https://www.cscareerkaizen.com/about)
- [気づけばプロ並みPHP 改訂版](https://www.ric.co.jp/book/programming/detail/192)
- [HTML、CSS をマスター](https://www.udemy.com/course/html5css3-b/)
- [フロントエンドウェブ開発をBootstrap Vueでスタート!!](https://www.udemy.com/course/tanakatakashi-01bootstrapvue/)
- [bootstrap]()

### 8.3. セキュリティ教材

- [本当は怖いファイルアップロード攻撃](https://at-virtual.net/securecoding/%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%A2%E3%83%83%E3%83%97%E3%83%AD%E3%83%BC%E3%83%89%E6%94%BB%E6%92%83%E3%81%AE%E7%90%86%E8%A7%A3%E3%81%A8%E4%BF%AE%E6%AD%A3%E6%96%B9%E6%B3%95/)
- [PHPセキュリティー](https://wepicks.net/category/phpsecurity/)

<br>

