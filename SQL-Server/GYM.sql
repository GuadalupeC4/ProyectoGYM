CREATE DATABASE GYM;

use GYM;

create table admi(
     idAdmi int identity not null primary key,
	 nombre varchar(150),
	 contraseña binary(100)
);


-- Función para encriptar la contraseña --
go
create function fun_encriptar(@valor varchar(255))
returns binary(100)
as 
begin
   declare @encriptado binary(100);
   set @encriptado=HASHBYTES('SHA1',@valor);
   return @encriptado;
end 


create table paquetes(
     idPaquete int identity not null primary key,
	 nombrePaquete varchar(150),
	 descripcion varchar(255),
	 precio decimal (10,2), 
	 imagen NVARCHAR(250)
);

create table clientes(
     idCliente int identity not null primary key,
	 nombreCliente varchar(150),
	 inscripcion date,
	 renovacion date, 
	 idPaquete int not null,
	 dias int,
	 estado varchar(20) DEFAULT 'Vigente',
	 foreign key (idPaquete) references paquetes(idPaquete)
);
--Vigente, Por vencer, Vencido--

CREATE PROCEDURE spInsertarCliente
    @nombre VARCHAR(150),
    @inscripcion DATE,
    @idPaquete INT
AS
BEGIN
    DECLARE @renovacion DATE;
    DECLARE @dias INT;

    -- Calcular la fecha de renovación (un mes después de inscripción)
    SET @renovacion = DATEADD(MONTH, 1, @inscripcion);

    -- Ajustar al último día del mes si es necesario
    IF DAY(@renovacion) < DAY(@inscripcion)
        SET @renovacion = EOMONTH(@renovacion);

    -- Calcular los días restantes desde hoy hasta la renovación
    SET @dias = DATEDIFF(DAY, GETDATE(), @renovacion);

    -- Insertar los datos en la tabla
    INSERT INTO clientes (nombre, inscripcion, renovacion, idPaquete, dias)
    VALUES (@nombre, @inscripcion, @renovacion, @idPaquete, @dias);
END;


CREATE TRIGGER trg_ActualizarEstado
ON clientes
AFTER UPDATE
AS
BEGIN
    -- Cambiar estado a 'Por vencer' cuando dias = 5
    UPDATE clientes
    SET estado = 'Por vencer'
    WHERE dias = 5 AND estado != 'Por vencer';

    -- Cambiar estado a 'Vencido' cuando dias = 0
    UPDATE clientes
    SET estado = 'Vencido'
    WHERE dias = 0 AND estado != 'Vencido';
END;

drop trigger trg_ActualizarEstado

DROP PROCEDURE spInsertarCliente;


create table productos(
     idProducto int identity not null primary key,
	 nombreProducto varchar(150),
	 descripcion varchar(255),
	 precio decimal (10,2), 
	 imagen NVARCHAR(250)
);

create table horarios(
     idHorario int identity not null primary key,
	 nombre varchar(150),
	 dias varchar(50),
	 hora varchar(20)
);


--DROP FUNCTION IF EXISTS fun_encriptar;

insert into admi values ('admin',(select dbo.fun_encriptar('admin')));


insert into paquetes values ('Paquete fit', 'cardio, area de peso', 350);

insert into clientes values ('Pedro', '19/01/25', '19/02/25', 1, 19, 'Vigente');

INSERT INTO clientes (nombreCliente, inscripcion, renovacion, idPaquete, dias, estado) 
VALUES (
    'Pedro', 
    '2025-01-19', 
    DATEADD(MONTH, 1, '2025-01-19'), 
    1, 
    DATEDIFF(DAY, GETDATE(), DATEADD(MONTH, 1, '2025-01-19')),
    'Vigente'
);

select * from paquetes;
select * from clientes;
select * from productos;


drop table clientes;
drop table paquetes;
drop table productos;


INSERT INTO clientes (nombre, inscripcion, idPaquete) 
                VALUES ('Juan', '2025-01-19', DATEADD(MONTH, 1, '2025-01-19'), 1, 
                DATEDIFF(DAY, GETDATE(), DATEADD(MONTH, 1, '2025-01-19')), 'Vigente')


SELECT 
        c.nombre,
        c.inscripcion,
        c.renovacion,
        p.nombre,
        c.dias,
        c.estado
        FROM clientes c, paquetes p WHERE c.idPaquete = p.idPaquete;

		SELECT 
                c.idCliente, 
                c.nombre,
                c.inscripcion, 
                c.renovacion, 
                p.nombre, 
                c.dias, 
                c.estado
            FROM 
                clientes c
            INNER JOIN 
                paquetes p 
            ON 
                c.idPaquete = p.idPaquete
            WHERE 
                c.idCliente = idCliente


CREATE FUNCTION ObtenerEstado(@dias INT)
RETURNS VARCHAR(20)
AS
BEGIN
    RETURN (
        CASE 
            WHEN @dias = 0 THEN 'Vencido'
            WHEN @dias = 5 THEN 'Por vencer'
            ELSE 'Vigente'
        END
    );
END;