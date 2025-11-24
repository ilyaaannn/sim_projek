use projec_sim;

CREATE TABLE tbl_user (
    id_user INT(100) NOT NULL PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    level CHAR(10) NOT NULL CHECK (level IN ('kostumer' , 'admin', 'staff')),
    alamat VARCHAR(200) NOT NULL,
    phone INT(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(20) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

insert into tbl_user (id_user, username, level, alamat, phone, email, password, created_at, updated_at) values
(1001, 'ilyan', 'admin', 'duri', '8318445', 'ilyanadmin@gmail.com', 'ilyanadmin', NOW(), NOW()),
(1002, 'farid', 'admin', 'pakning', '8526415', 'faridadmin@gmail.com', 'faridadmin', NOW(), NOW()),
(1003, 'lina', 'staff', 'bengkalis', '8238635', 'linastaff@gmail.com', 'linastaff', NOW(), NOW()),
(1004, 'petra', 'staff', 'rohul', '8127015', 'petrastaff@gmail.com', 'petrastaff', NOW(), NOW()),
(1005, 'linda', 'kostumer', 'bengkalis', '8518450', 'lindakostumer@gmail.com', 'lindakostumer', NOW(), NOW()),
(1006, 'noufan', 'kostumer', 'bengkalis', '8137238', 'noufankostumer@gmail.com', 'noufankostumer', NOW(), NOW()),
(1007, 'nazril', 'kostumer', 'sumbar', '8576246', 'nazrilkostumer@gmail.com', 'nazrilkostumer', NOW(), NOW());