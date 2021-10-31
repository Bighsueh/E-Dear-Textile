### 資料庫設計

####資料表:
1. Users 主管、員工使用者列表
2. job_tickets 派工單資訊
3. job_titles 紀錄任務職位
4. job_reports 作業回報紀錄


####資料庫欄位設計
Users
1. user_id 使用者id
2. name 使用者名稱
3. account 帳號
4. password 密碼
5. level 使用者級別

job_tickets


job_titles
1. ticket_id 派遣單號
2. title 授權項目
3. authorizer 授權人
4. authorized_person 被授權人



job_reports  
1. Piping 滾邊員  
2. user_id 使用者id(這裡為剪巾員)  
3. ticket_id 派遣單id  
4. piping_order 滾邊完成訂單數  
5. created_at 新增日期  
6. update_at 更新日期  
7. cut_order 剪巾完成訂單數
