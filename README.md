#Overview of system
The goal of my system was for users to be able to create an account or login, once logged in the user can then withdraw, lodge, transfer, transaction history, check balance, view their info and delete their account.
The user can transfer money to another account if they know the account id.
The user can’t withdraw more money than they currently have.
The user can’t send more then 10,000000 to another account.
The user should be able to see their balance any time.
The user Be able to view transaction history. W stands for withdrawal, L stands for lodgement, I stand for incoming,     O stands for outwards.
The user can view their info.

#Database
The name of my database is ‘Banking.sql’. The following is the table and their contents
#Guest_information
•	Guestid (PK)
•	First_name
•	Last_name
•	Dob
•	Address
•	Area
•	County
•	Phone
#Account
•	AccountID (PK)
•	Guest_id (FK)
•	Date
•	Balance
•	Account ('NULL','CA','SA','MA','CD')
#Transaction_history
•	Transactionid (PK)
•	Account_id (FK)
•	Amount
•	Transaction ('NULL','W','I','L','O')

#Elements of system
Balance.php
•	Select – line 9
Create.php
•	Insert – line 124
createAccount.php
•	Select – line 7
•	Insert – line 27
•	Select – line 38
Delete.php
•	Select – line 9
•	Delete – line 17
•	Delete – line 22
•	Delete – line 27
Info.php
•	Joined select – line 9
Lodgment.php
•	Select – line 12
•	Update – line 24
•	Select – line 31
•	Insert – line 41
Login.php
•	Select – line 14
Transaction.php
•	Select – line 9
Transfer.php
•	Select – line 21
•	Select – line 43
•	Update – line 55
•	Select – line 62
•	Update – line 71
•	Insert – line 78
•	Insert – line 84
Withdrawl.php
•	Select – line 13
•	Update – line 25
•	Select – line 32
•	Insert – line 42

