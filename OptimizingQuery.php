//to optimize the query , you need to : 
- have created_at columns in the users table will make sorting faster
- add index to status/created_at column
Finally run query : 
SELECT * FROM users WHERE status = 'active' ORDER BY created_at DESC LIMIT 50