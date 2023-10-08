
Fetch record
account = $db->query('SELECT * FROM accounts WHERE username = ? AND password = ?', 'test', 'test')->fetchArray();
echo $account['name'];

account = $db->query('SELECT * FROM accounts WHERE username = ? AND password = ?', array('test', 'test'))->fetchArray();
echo $account['name'];
Fetch multiple records
accounts = $db->query('SELECT * FROM accounts')->fetchAll();

foreach ($accounts as $account) {
	echo $account['name'] . '<br>';
}
db->query('SELECT * FROM accounts')->fetchAll(function($account) {
    echo $account['name'];
});you need to break the loop you can add:

return 'break'; 

accounts = $db->query('SELECT * FROM accounts');
echo $accounts->numRows();

insert = $db->query('INSERT INTO accounts (username,password,email,name) VALUES (?,?,?,?)', 'test', 'test', 'test@gmail.com', 'Test');
echo $insert->affectedRows();
echo $db->query_count
echo $db->lastInsertID();