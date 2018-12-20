CREATE TABLE ISCO_Accion (
	id_accion int primary key identity,
	descripcion nvarchar(50) NOT NULL,
	alias nvarchar(50) NULL,
	nivel int not null default 0,
	id_padre int null default 0,
	activo bit NOT NULL default 1
);

CREATE TABLE ISCO_Pregunta (
	id_pregunta int primary key identity,
	descripcion nvarchar(100) NOT NULL,
	activo bit NOT NULL default 1
);

CREATE TABLE ISCO_Rol (
	id_rol int primary key identity,
	descripcion nvarchar(100) NOT NULL,
	activo bit NOT NULL default 1
);

CREATE TABLE ISCO_RolAccion(
	id_rol int NOT NULL,
	id_accion int NOT NULL,
	modifica bit NOT NULL default 1,
	primary key (id_rol,id_accion)
);

CREATE TABLE ISCO_Usuario(
	id_usuario int primary key IDENTITY,
	usuario nvarchar(20) NOT NULL,
	correo nvarchar(100) NOT NULL,
	cedula nvarchar(15) NOT NULL,
	clave nvarchar(100) NOT NULL,
	nombre nvarchar(100) NOT NULL,
	apellido nvarchar(100) NOT NULL,
	sexo char(1) NOT NULL DEFAULT 'M',
	respuesta_seguridad nvarchar(1000) NULL,
	fecha_registro datetime NOT NULL DEFAULT GETDATE(),
	telefono nvarchar(20) NULL,
	activo bit NOT NULL DEFAULT 1,
	id_rol int NOT NULL,
	id_pregunta int NULL,
	CodUbic nvarchar(10) not null
);

CREATE TABLE ISCO_Registro (
	id_registro numeric(20, 0) primary key IDENTITY,
	usuario nvarchar(50) NOT NULL,
	comentario text NULL,
	pagina nvarchar(100) NOT NULL,
	fecha datetime NOT NULL default GETDATE(),
	ip nvarchar(20) NOT NULL,
	equipo nvarchar(100) NOT NULL
);

/********************************************* CONDOMINIO **********************************************************/
CREATE TABLE ISCO_Presupuestos(
	numerod nvarchar(20) NOT NULL,
	fecha datetime NULL DEFAULT getdate(),
	usuario nvarchar(50) NOT NULL,
	activo bit NULL DEFAULT 1
);

CREATE TABLE ISCO_Correlativo(
	id_correlativo int IDENTITY PRIMARY KEY,
	NumeroD nvarchar(20) NOT NULL,
	prefijo nvarchar(15) NOT NULL DEFAULT (''),
	fecha datetime NOT NULL DEFAULT getdate()
);

CREATE TABLE ISCO_Ubicacion(
	id_ubicacion int IDENTITY PRIMARY KEY,
	nombre nvarchar(100) NOT NULL,
	activo bit NOT NULL DEFAULT 1);

CREATE TABLE ISCO_Piso(
	id_piso int IDENTITY PRIMARY KEY,
	nombre nvarchar(100) NOT NULL,
	activo bit NOT NULL DEFAULT 1);

CREATE TABLE ISCO_Local(
	id_local int IDENTITY PRIMARY KEY,
	CodClie nvarchar(15) NOT NULL,
	CodVend nvarchar(10) NULL,
	id_ubicacion int NOT NULL DEFAULT 1,
	id_piso int NOT NULL DEFAULT 1,
	descripcion nvarchar(100) NULL,
	alquiler bit NULL DEFAULT 1,
	metro numeric(10, 2) NULL DEFAULT 0,
	tipo_alquiler smallint NULL DEFAULT 0,
	monto_alquiler numeric(12, 2) NULL DEFAULT 0,
	porcentaje_alquiler numeric(5, 2) NULL DEFAULT 0,
	monto_alicuota numeric(12, 2) NULL DEFAULT 0,
	porcentaje_alicuota numeric(5, 2) NULL DEFAULT 0,
	activo bit NOT NULL DEFAULT 1);

CREATE TABLE ISCO_Correl(
	id_correl int IDENTITY primary key,
	CodVend nvarchar(10) NOT NULL unique,
	canon numeric(12, 2) NULL DEFAULT 0,
	activo bit default 1);

CREATE TABLE ISCO_UbicacionCentro(
	CodUbic nvarchar(10) not null,
	CodVend nvarchar(10) NOT NULL,
	primary key (CodUbic,CodVend));
/*---------------------------------------------------------- ALTER TABLES ------------------------------------------------------*/
ALTER TABLE ISCO_RolAccion ADD CONSTRAINT fk_corol_accion01 FOREIGN KEY (id_rol) REFERENCES ISCO_Rol (id_rol) ON DELETE CASCADE;
ALTER TABLE ISCO_RolAccion ADD CONSTRAINT fk_corol_accion02 FOREIGN KEY (id_accion) REFERENCES ISCO_Accion (id_accion) ON DELETE CASCADE;

ALTER TABLE ISCO_Usuario ADD CONSTRAINT fk_cousuario_rol FOREIGN KEY (id_rol) REFERENCES ISCO_Rol (id_rol);
ALTER TABLE ISCO_Usuario ADD CONSTRAINT fk_cousuario_pregunta FOREIGN KEY (id_pregunta) REFERENCES ISCO_Pregunta(id_pregunta);
ALTER TABLE ISCO_Usuario add unique (usuario);

ALTER TABLE ISCO_Local ADD CONSTRAINT fk_colocal_ubicacion FOREIGN KEY (id_ubicacion) REFERENCES ISCO_Ubicacion (id_ubicacion);
ALTER TABLE ISCO_Local ADD CONSTRAINT fk_colocal_piso FOREIGN KEY (id_piso) REFERENCES ISCO_Piso (id_piso);

/*---------------------------------------------------------- INSERTS -------------------------------------------------------------*/
INSERT INTO ISCO_Pregunta(descripcion) VALUES ('Lugar de Nacimiento');
INSERT INTO ISCO_Pregunta(descripcion) VALUES ('Segundo nombre de su Padre');
INSERT INTO ISCO_Pregunta(descripcion) VALUES ('Segundo nombre de su Madre');
INSERT INTO ISCO_Pregunta(descripcion) VALUES ('Héroe de infancia');
INSERT INTO ISCO_Pregunta(descripcion) VALUES ('Lugar de Luna de miel');

INSERT INTO ISCO_Rol(descripcion) VALUES ('En Espera');
INSERT INTO ISCO_Rol(descripcion) VALUES ('Usuario');
INSERT INTO ISCO_Rol(descripcion) VALUES ('Administrador');

INSERT INTO ISCO_Usuario(usuario,correo,cedula,clave,nombre,apellido,sexo,respuesta_seguridad,id_pregunta,id_rol, CodUbic) 
VALUES ('001','nada@nada.com','123456','9df3bb42df815f39041a621f7282a475','Innova','Administrador','M','CCS',1,3,'01');

INSERT ISCO_PISO (nombre) VALUES ('Planta Baja');
INSERT ISCO_UBICACION (nombre) VALUES ('Central');
