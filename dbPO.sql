DROP DATABASE dbPO;
CREATE DATABASE IF NOT EXISTS dbPO;
USE dbPO;
CREATE TABLE tbStatus (
	id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status 		VARCHAR(1),
	description VARCHAR(255)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB;
CREATE TABLE tbType (
	id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	type 		VARCHAR(4),
	description VARCHAR(255)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB;
CREATE TABLE tbCategory (
	id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	category	VARCHAR(4),
	description VARCHAR(255)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB;
CREATE TABLE tbSupplier (
	id 			INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	company 	VARCHAR(255), 
	contact 	VARCHAR(255), 
	address1 	VARCHAR(255),
	address2 	VARCHAR(255),
	city 		VARCHAR(255),
	state 		VARCHAR(255),
	country		VARCHAR(255),
	postcode 	VARCHAR(255),
	phone 		VARCHAR(30),
	mobile		VARCHAR(30),
	fax 		VARCHAR(30),
	email 		VARCHAR(255),
	www 		VARCHAR(255),
	active		BOOLEAN DEFAULT TRUE
) DEFAULT CHARSET=utf8 ENGINE=InnoDB;
CREATE TABLE tbPart 
(
	id				INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	partNumber		VARCHAR(255) UNIQUE,
	description		VARCHAR(255),
	drawingNumber 	VARCHAR(255),
	typeid			INT DEFAULT 1,
	active			BOOLEAN DEFAULT TRUE,
	FOREIGN KEY (typeid) REFERENCES tbType(id)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB AUTO_INCREMENT=300000;
CREATE TABLE tbPurchaseOrder
(
	id				INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	po_number		VARCHAR(255) NOT NULL UNIQUE,
	po_date			DATE NOT NULL,
	supplierid		INT NOT NULL,
	active			BOOLEAN DEFAULT TRUE,
	FOREIGN KEY (supplierid) REFERENCES tbSupplier(id)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB;
CREATE TABLE tbPurchaseLine
(
	purchaseid		INT NOT NULL,
	line			INT NOT NULL,
	partid 			INT,
	qty				INT,
	job 			VARCHAR(8),
	price 			DECIMAL(14,2),
	PRIMARY KEY (purchaseid, line),
	FOREIGN KEY (purchaseid) REFERENCES tbPurchaseOrder(id),
	FOREIGN KEY (partid) REFERENCES tbPart(id)
) DEFAULT CHARSET=utf8 ENGINE=InnoDB;


#Fill Table with DATA
INSERT into tbStatus (status, description) VALUES ('O', 'Line item is open');
INSERT into tbStatus (status, description) VALUES ('C', 'Line item is closed');
INSERT into tbStatus (status, description) VALUES ('R', 'Line item has been returned');
INSERT into tbStatus (status, description) VALUES ('B', 'Line item is back ordered');

#Fill Table with DATA
INSERT into tbType (type, description) VALUES ('RAW', 'Raw material');
INSERT into tbType (type, description) VALUES ('HYD', 'Hydraulic components');
INSERT into tbType (type, description) VALUES ('ELE', 'Electrical components');
INSERT into tbType (type, description) VALUES ('VEH', 'Truck');
INSERT into tbType (type, description) VALUES ('SUB', 'Sub contract requirement');

INSERT INTO tbSupplier SET company = 'ALL CUT TOOLS';
INSERT INTO tbSupplier SET company = 'ALL STEEL MERCHANTS';
INSERT INTO tbSupplier SET company = 'ANGLO DESIGN';
INSERT INTO tbSupplier SET company = 'ASHDOWNS';
INSERT INTO tbSupplier SET company = 'AUSTRAL ALLOYS';
INSERT INTO tbSupplier SET company = 'BARRON & RAWSON';
INSERT INTO tbSupplier SET company = 'R.BEAUCHAMPS';
INSERT INTO tbSupplier SET company = 'BROOKVALE ELECTRICAL';
INSERT INTO tbSupplier SET company = 'CCA';
INSERT INTO tbSupplier SET company = 'CGC FORGE';
INSERT INTO tbSupplier SET company = 'COLMAR';
INSERT INTO tbSupplier SET company = 'COLUSSI ENGINEERING';
INSERT INTO tbSupplier SET company = 'CROSS HYDRAULICS';
INSERT INTO tbSupplier SET company = 'EATON';
INSERT INTO tbSupplier SET company = 'ELSEMA';
INSERT INTO tbSupplier SET company = 'ENGINEERING RUBBERS';
INSERT INTO tbSupplier SET company = 'FORBES (AUST)';
INSERT INTO tbSupplier SET company = 'GEAR PUMPS AUSTRALIA';
INSERT INTO tbSupplier SET company = 'GSL';
INSERT INTO tbSupplier SET company = 'HALLITE';
INSERT INTO tbSupplier SET company = 'HARE & FORBES';
INSERT INTO tbSupplier SET company = 'HORAN STEEL';
INSERT INTO tbSupplier SET company = 'INTERNATIONAL SEAL Co';
INSERT INTO tbSupplier SET company = 'JTD ENGINEERING';
INSERT INTO tbSupplier SET company = 'KUBOTA TRACTORS';
INSERT INTO tbSupplier SET company = 'LASER FX';
INSERT INTO tbSupplier SET company = 'LINAK AUST';
INSERT INTO tbSupplier SET company = 'LINDE GAS';
INSERT INTO tbSupplier SET company = 'LOCKER GROUP';
INSERT INTO tbSupplier SET company = 'MACAM RUBBER';
INSERT INTO tbSupplier SET company = 'McNAUGHTANS';
INSERT INTO tbSupplier SET company = 'MEEK HONING';
INSERT INTO tbSupplier SET company = 'MOBILE ONE';
INSERT INTO tbSupplier SET company = 'DMG MORI SEIKI';
INSERT INTO tbSupplier SET company = 'NORTHSHORE PATTERN MAKERS';
INSERT INTO tbSupplier SET company = 'NORWEST ENGINES';
INSERT INTO tbSupplier SET company = 'OEM DYNAMICS';
INSERT INTO tbSupplier SET company = 'OLYMPIC INSTRUMENT SALES';
INSERT INTO tbSupplier SET company = 'OMRON';
INSERT INTO tbSupplier SET company = 'PARKER HANNIFIN';
INSERT INTO tbSupplier SET company = 'PEARSON CONTRACTING';
INSERT INTO tbSupplier SET company = 'POWERCLIPPER';
INSERT INTO tbSupplier SET company = 'PREFORMED LINE PRODUCTS';
INSERT INTO tbSupplier SET company = 'PRINCE';
INSERT INTO tbSupplier SET company = 'PTE HYDRAULICS';
INSERT INTO tbSupplier SET company = 'PUMPS & SPRAYS';
INSERT INTO tbSupplier SET company = 'R.S. COMPONENTS';
INSERT INTO tbSupplier SET company = 'RACK ZINC PLATING';
INSERT INTO tbSupplier SET company = 'REXROTH';
INSERT INTO tbSupplier SET company = 'ROSS BROWN SALES';
INSERT INTO tbSupplier SET company = 'SAUER DANFOSS DAIKIN';
INSERT INTO tbSupplier SET company = 'SIGMA HYDRAULICS';
INSERT INTO tbSupplier SET company = 'SILVERWATER WELDING';
INSERT INTO tbSupplier SET company = 'SOUTHCOTT';
INSERT INTO tbSupplier SET company = 'STAUFF';
INSERT INTO tbSupplier SET company = 'SYDNEY DRIVELINE';
INSERT INTO tbSupplier SET company = 'TOTAL RUBBER';
INSERT INTO tbSupplier SET company = 'TRADELINK';
INSERT INTO tbSupplier SET company = 'TRIGG BROS';
INSERT INTO tbSupplier SET company = 'TUGGERAH LAKES BATTERIES';
INSERT INTO tbSupplier SET company = 'UES';
INSERT INTO tbSupplier SET company = 'UNIVERSAL GASKETS';
INSERT INTO tbSupplier SET company = 'VEHICLE COMPONENTS';
INSERT INTO tbSupplier SET company = 'WARD ENGRAVING';
INSERT INTO tbSupplier SET company = 'WESTERN FILTERS';

INSERT IGNORE INTO tbPart (description, drawingnumber) VALUES ('Alpha Flush Box Machining','35A-111'),
('Alpha S-Tube','35A-311-2'),
('3 Trojan Swing Ram Cylinders','35T-311-2'),
('3½ Patriot Swing Ram Cylinders','35P-311-2'),
('2½ Alpha Swing Ram Cylinders','35A-311-2'),
('Patriot Flush Box Base Foldings','357-111-1F'),
('Patriot Flush Box Rail Foldings','357-111-2F'),
('Alpha Flush Box Base Foldings','35A-111-1F'),
('4 Swing Ram End Cap Clevis','357-311-1P'),
('4 Swing Ram End Cap','357-311-2P'),
('4 Swing Ram Clevis','357-307-P'),
('4 Patriot Bell Crank','357-406-P'),
('Wedge Pin Plate','357-5XXB-P'),
('Patriot Flush Box Cylinder Side - Material Drawing','357-111-3P'),
('Patriot Flush Box Hydraulic Side - Material Drawing','357-311-4P'),
('4 Swing Cylinder Gland Housing','357-311-3P'),
('4 Ram Gland Cap','357-305-1P'),
('9 Swinger Ram Mount A','357-514'),
('9 Swinger Ram Mount B','357-515');

#Fill Table with DATA
INSERT into tbCategory (category, description) VALUES 
('WEA', 'Wear part'),
('AIR', 'Air compressor'),
('WAT', 'Water blaster'),
('VIB', 'Vibrator'),
('CHE', 'Chemical pump');
