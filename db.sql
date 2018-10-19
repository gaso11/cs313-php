/* ID | Cost | Mileage | Time start | Time end | Make | Model | Rental status | Repair status */
CREATE TABLE Cars (
    CarID SMALLSERIAL PRIMARY KEY,
    Cost int NOT NULL,
    Mileage int NOT NULL,
    TimeStart TIME NOT NULL,
    TimeEnd TIME NOT NULL,
    Make varchar(255) NOT NULL,
    Model varchar(255) NOT NULL,
    RentalStatus varchar(255) NOT NULL,
    RepairStatus varchar(255) NOT NULL
);

/* I decided I wanted to have the renters name associated with the car */
ALTER TABLE Cars
ADD RenterFirstName varchar(255), #not "NOT NULL" in case nobody is renting the car
ADD RenterLastName varchar(255);

/* I want to see my table */
CREATE VIEW CarsView AS
SELECT CarID, Cost, Mileage, TimeStart, TimeEnd, Make, Model, RentalStatus, RepairStatus, RenterFirstName, RenterLastName
FROM Cars;

/* Checking my empty table */
SELECT * FROM CarsView;

/* Decided time should be allowed null */
ALTER TABLE Cars ALTER COLUMN TimeStart DROP NOT NULL;
ALTER TABLE Cars ALTER COLUMN TimeEnd DROP NOT NULL;

/* Can't change data types in a view */
DROP VIEW CarsView

/* Try change again */
ALTER TABLE Cars ALTER COLUMN TimeStart DROP NOT NULL;
ALTER TABLE Cars ALTER COLUMN TimeEnd DROP NOT NULL;

/* I want my view back */
CREATE VIEW CarsView AS
SELECT CarID, Cost, Mileage, TimeStart, TimeEnd, Make, Model, RentalStatus, RepairStatus, RenterFirstName, RenterLastName
FROM Cars;

/* No idea if that worked, but my table is still there */
SELECT * FROM CarsView;

/* Decided employee login should have a seperate table */
CREATE TABLE Employees (
    EmpID SMALLSERIAL PRIMARY KEY,
    FirstName varchar(255) NOT NULL,
    LastName varchar(255)
);

/* Create a view for this too */
/* After reading Week 05, this is not needed */
CREATE VIEW EmpView AS
SELECT EmpID, FirstName, LastName
FROM Employees;

/*
 _    _           _      _____ 
| |  | |         | |    |  ___|
| |  | | ___  ___| | __ |___ \ 
| |/\| |/ _ \/ _ \ |/ /     \ \
\  /\  /  __/  __/   <  /\__/ /
 \/  \/ \___|\___|_|\_\ \____/
*/

/* Place values in  */
INSERT INTO Employees (FirstName, LastName) VALUES ('Evan', 'Lewis');

/* CarID, TimeStart and TimeEnd don't need to be set */
INSERT INTO Cars 
(Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
(39, 22125.3, 'Nissan', 'Versa', 'Open', 'Okay');

INSERT INTO Cars 
(Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
(50, 22191.1, 'Hyundai', 'Santa Fe', 'Open', 'Okay');

INSERT INTO Cars 
(Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
(45, 22687.3, 'Ford', 'Fiesta', 'Open', 'Okay');

INSERT INTO Cars 
(Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
(43, 23016.5, 'Kia', 'Soul', 'Open', 'Okay');

INSERT INTO Cars 
(Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
(129, 23571.1, 'Ford', 'F150', 'Open', 'Okay');

INSERT INTO Cars 
(Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
(100, 25000, 'Ford', 'Transit', 'Closed', 'In Shop');
