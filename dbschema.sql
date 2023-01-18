create database farmr;

use farmr;

create table farms ( 
        id char(200) primary key,
        publicAPI boolean, 
        user nchar(200) not null,
        data long ,
        lastUpdated timestamp
 );
 
 create table configs (
        id char(200) primary key, 
        config varchar(60000)
       );
       
 create table lastplot (
        id char(200) primary key, 
        lastplot varchar(200)
        );
        
 create table balances (id char(200) primary key
                        , balance varchar(200));
                        
create table notifications (
       notificationID int AUTO_INCREMENT primary key  ,
       user varchar(200),
       type varchar(200),
       name varchar(200)) ;                               
      
 create table statuses (
        id char(200) primary key,
        isfarming int
        );
        
 create table offline ( 
        id char(200) primary key,
        notify int , 
        name varchar(200)
        );
