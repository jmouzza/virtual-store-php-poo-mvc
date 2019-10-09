CREATE DATABASE tienda_master;
USE tienda_master;

# SIEMPRE CREAR LAS TABLAS EN ORDEN (PRIMERO LAS TABLAS SIN FOREIGN KEY) #

CREATE TABLE usuarios (
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
apellidos   varchar(100) not null,
email       varchar(255) not null,
password    varchar(255) not null,
rol         varchar(20),
imagen      varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY (id),
CONSTRAINT uq_email UNIQUE (email)
)ENGINE=InnoDb;

CREATE TABLE categorias (
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE productos (
id              int(255) auto_increment not null,
categoria_id    int(255) not null,
nombre          varchar(150) not null,
descripcion     text,
precio          float(100,2) not null,
stock           int(255) not null,
oferta          varchar(2),
fecha           date not null,
imagen          varchar(255),
CONSTRAINT pk_productos PRIMARY KEY (id),
CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id) REFERENCES categoria(id)
)ENGINE=InnoDb;

CREATE TABLE pedidos (
id          int(255) auto_increment not null,
usuario_id  int(255) not null,
region      varchar(100) not null,
comuna      varchar(100) not null,
direccion   varchar(255) not null,
coste       float (200,2) not null,
estado      varchar(50) not null,
fecha       date,
hora        time,
CONSTRAINT pk_pedidos PRIMARY KEY (id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos (
id          int(255) auto_increment not null,
pedido_id   int(255) not null,
producto_id int(255) not null,
unidades    int(255) not null,
CONSTRAINT pk_pedidos PRIMARY KEY (id),
CONSTRAINT fk_lineap_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_lineap_producto FOREIGN KEY (producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;