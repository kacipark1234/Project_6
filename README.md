# Project_6

專案名稱: 簡易網路相簿

相簿功能:
1. 登入註冊
2. 瀏覽/新增/刪除/修改相簿
3. 瀏覽/上傳/刪除/修改相片

檔案介紹: 
AddAlbum.php	新增相簿  
addUser.php     註冊帳號  
dbtools.inc.php 連接資料庫  
deleteAlbum.php	刪除相簿  
deletePhoto.php 刪除相片  
edit.php	    編輯相簿畫面  
editPhoto.php   編輯相片畫面  
index.php       相簿主頁  
login.php       登入  
logout.php      登出  
photoDetail.php 顯示相片  
showAlbum.php	顯示相簿列表  
uploadPhoto.php 上傳相片  

## 登入(login.php)
在資料庫中查詢帳號密碼是否正確
![image](https://user-images.githubusercontent.com/93324400/172579966-6a654b0b-6f47-4f40-871b-dc8e8df103bf.PNG)

## 註冊(addUser.php)
在資料庫中查詢帳號有無註冊，並新增至資料庫
![image](https://user-images.githubusercontent.com/93324400/172580350-4cc0347a-3db9-4741-a3b5-53f1e5a621c5.png)

## 相簿總覽(index.php)
搜尋資料庫所有相簿，並顯示
### 未登入畫面
相簿會顯示無法編輯
![image](https://user-images.githubusercontent.com/93324400/172581908-f26f0b04-5745-4d2e-badd-d0cae60b6dee.png)

### 已登入畫面
你的相簿會顯示(編輯/刪除/新增相簿)功能
![image](https://user-images.githubusercontent.com/93324400/172582961-e539814f-e73e-4a86-93c4-91fdc1a80fd0.png)

## 創建相簿(AddAlbum.php)
輸入名稱，新增至資料庫
![image](https://user-images.githubusercontent.com/93324400/172608916-31f8a841-3229-44fe-b271-e29714262615.png)

## 編輯相簿(edit.php)
更新資料庫相簿名稱
![image](https://user-images.githubusercontent.com/93324400/172609208-46fbd8c5-9141-400b-ad5a-cbb27689a78f.png)

## 相簿內容畫面(showAlbum.php)
搜尋資料庫特定相簿和符合該相簿的照片
### 未登入畫面
![image](https://user-images.githubusercontent.com/93324400/172607731-e892d3f5-05ef-4852-af98-ce594c27cd27.png)

### 已登入畫面
你的相簿會顯示(編輯/刪除/上傳相片)功能
![image](https://user-images.githubusercontent.com/93324400/172583436-7f6b9f3e-639c-46eb-ad62-54c2c9a9158c.png)

## 編輯相片(editPhoto.php)
更新資料庫的相片資訊
![image](https://user-images.githubusercontent.com/93324400/172609380-6ab2e332-c9e5-4af8-a0fc-909ae4d3e74c.png)

## 相片上傳(uploadPhoto.php)
選擇檔案並輸入名字與內容，將資料新增至資料庫
![image](https://user-images.githubusercontent.com/93324400/172608007-9d8e001f-47c6-47df-aff9-3995dd986210.png)

## 相片瀏覽頁面(photoDetail.php)
搜尋資料庫顯示相片與內容，下面有圖片能連結至其他同相簿的照片
![image](https://user-images.githubusercontent.com/93324400/172608384-87ff4af6-271b-4a64-9c04-8d8bca88ddae.png)

# MySQL設置

```sql
CREATE DATABASE `Portfolio_6`;    /*創建名稱為 Portfolio_6 的資料庫*/ 
USE `Portfolio_6`;                /*使用 Portfolio_6 資料庫*/ 
CREATE TABLE `album`(             
    `id` int primary key,         
    `name` VARCHAR(256),  
    `owner` VARCHAR(32)
);
CREATE TABLE `photo`(     
    `id` int auto_increment primary key,
    `name` VARCHAR(64),  
    `filename` VARCHAR(64),  
    `comment` VARCHAR(512),  
    `album_id` int
);
CREATE TABLE `users`(     
    `account` VARCHAR(32) primary key,
    `password` VARCHAR(32),  
    `name` VARCHAR(32)
);
```
# PHP與MySQL連線
localhost:主機名或IP地址  
root:MySQL用戶名  
07360514:MySQL密碼  
```php
<?php
  function create_connection(){
    $link = mysqli_connect("localhost","root","07360514") or die("無法連接".mysqli_connect_error());  //
    return $link;
  }
  function execute_sql($link ,$database,$sql){
    mysqli_select_db($link,$database) or die("開啟資料庫失敗".mysqli_error($link));
    $result = mysqli_query($link,$sql);
    return $result;
  }
?>

```





