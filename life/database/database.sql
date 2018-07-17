
CREATE TABLE IF NOT EXISTS `branch`(
`branchno` int NOT NULL primary key,
`location` varchar(30) NOT NULL
);

insert into `branch` values
(1,'bangalore'),
(2,'mumbai'),
(3,'delhi'),
(4,'chennai'),
(5,'dubai');


CREATE TABLE IF NOT EXISTS `policy`(
`policy_no` int NOT NULL primary key,
`mat_val` int NOT NULL,
`ins_prem` int NOT NULL,
`mat_period` int NOT NULL
);

insert into `policy` values
(1,500000,50000,12),
(2,1000000,20000,60),
(3,2000000,25000,48),
(4,1000000,10000,120);


CREATE TABLE IF NOT EXISTS `agent` (
`eno` int NOT NULL primary key,
`name` varchar(30) NOT NULL,
`dob` date NOT NULL,
`gender` char NOT NULL,
`phone` varchar(10) NOT NULL,
`branchno` int NOT NULL,
foreign key (`branchno`) references branch (`branchno`) on delete cascade
);

CREATE TABLE IF NOT EXISTS `customer` (
`cid` int NOT NULL primary key,
`name` varchar(30) NOT NULL,
`phone` varchar(10) NOT NULL,
`address` varchar(100) NOT NULL,
`dob` date NOT NULL,
`eno` int NOT NULL,
`policy_no` int NOT NULL,
`startdate` date NOT NULL,
foreign key(`eno`) references agent (`eno`) on delete cascade,
foreign key(`policy_no`) references policy (`policy_no`) on delete cascade

);

CREATE TABLE IF NOT EXISTS `nominee`(
`cid` int NOT NULL,
`name` varchar(30) NOT NULL,
`dob` date NOT NULL,
`phone` varchar(10) NOT NULL,
`address` varchar(100) NOT NULL,
`relationship` varchar(20) NOT NULL,
foreign key (`cid`) references `customer`(`cid`) on delete cascade,
primary key(`cid`,`name`)
);

CREATE TABLE IF NOT EXISTS `userinfo`
(
`username` varchar(30) NOT NULL primary key,
`password` varchar(30) NOT NULL,
`type` varchar(20) NOT NULL,
`id` int
);