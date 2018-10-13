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

/* Try to put in a default value */
UPDATE Employees
SET FirstName='Evan', LastName='Lewis'
WHERE EmpID = 1;

/* Create a view for this too */
CREATE VIEW EmpView AS
SELECT EmpID, FirstName, LastName
FROM Employees;
/* The default value didn't give me an error, but I don't
see it in the view, maybe I did that wrong? */