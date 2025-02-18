-- CREATE TABLE IF NOT EXIST Users (
--     [id] INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
--     [login] VARCHAR(255),
--     [password] VARCHAR(255),
--     [email] VARCHAR(255),
--     [picture] VARCHAR(255)
-- );

IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Users')
BEGIN
    CREATE TABLE [Users] (
        [id] INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
        [login] NVARCHAR(255) NOT NULL,
        [password] NVARCHAR(255) NOT NULL,
        [email] NVARCHAR(255) NOT NULL UNIQUE,
        [picture] NVARCHAR(255)
    );
END;
