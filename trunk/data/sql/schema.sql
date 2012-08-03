CREATE TABLE capitulo (id BIGINT AUTO_INCREMENT, idepisodio BIGINT NOT NULL, titulo VARCHAR(150) NOT NULL, descripcion text NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idepisodio_idx (idepisodio), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE categoriaContenido (id BIGINT AUTO_INCREMENT, texto text NOT NULL, imagen VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE comentario (id BIGINT AUTO_INCREMENT, idusuario BIGINT NOT NULL, idunidadtematica BIGINT NOT NULL, publicacion text NOT NULL, archivo VARCHAR(255) NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idusuario_idx (idusuario), INDEX idunidadtematica_idx (idunidadtematica), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE configuracion (id BIGINT AUTO_INCREMENT, variable VARCHAR(255), valor TEXT, descripcion LONGBLOB, tipo VARCHAR(8) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE contacto (id BIGINT AUTO_INCREMENT, nombre VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, telefono VARCHAR(20), empresa VARCHAR(100), comentario TEXT, documento TEXT, borrado TINYINT(1) DEFAULT '0' NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE contenido (id BIGINT AUTO_INCREMENT, idusuario BIGINT NOT NULL, idcategoriacontenido BIGINT NOT NULL, titulo VARCHAR(255) NOT NULL, contenido text NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idusuario_idx (idusuario), INDEX idcategoriacontenido_idx (idcategoriacontenido), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE contenidoPadresYProfesores (id BIGINT AUTO_INCREMENT, idepisodio BIGINT NOT NULL, titulo VARCHAR(150) NOT NULL, contenido text NOT NULL, enlacevideo VARCHAR(255), soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idepisodio_idx (idepisodio), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE elExperto (id BIGINT AUTO_INCREMENT, idepisodio BIGINT NOT NULL, enlacevideo VARCHAR(255) NOT NULL, descripcion text NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idepisodio_idx (idepisodio), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE episodio (id BIGINT AUTO_INCREMENT, idunidadtematica BIGINT NOT NULL, titulo VARCHAR(150) NOT NULL, descripcion text NOT NULL, enlacevideo VARCHAR(255), soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idunidadtematica_idx (idunidadtematica), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE fotografiaCapitulo (id BIGINT AUTO_INCREMENT, idcapitulo BIGINT NOT NULL, descripcion text NOT NULL, fotografia VARCHAR(255) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idcapitulo_idx (idcapitulo), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE fotografiaContenidoPadresYProfesores (id BIGINT AUTO_INCREMENT, idcontenidopadresyprofesores BIGINT NOT NULL, descripcion text NOT NULL, fotografia VARCHAR(255) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idcontenidopadresyprofesores_idx (idcontenidopadresyprofesores), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE fotografiaProducto (id BIGINT AUTO_INCREMENT, idproducto BIGINT NOT NULL, descripcion text NOT NULL, fotografia VARCHAR(255) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idproducto_idx (idproducto), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE fotografiaProgramaColegio (id BIGINT AUTO_INCREMENT, idprogramacolegio BIGINT NOT NULL, descripcion text NOT NULL, fotografia VARCHAR(255) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idprogramacolegio_idx (idprogramacolegio), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE juegoEpisodio (id BIGINT AUTO_INCREMENT, idepisodio BIGINT NOT NULL, titulo VARCHAR(150) NOT NULL, enlacejuego VARCHAR(255) NOT NULL, descripcion text NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idepisodio_idx (idepisodio), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE producto (id BIGINT AUTO_INCREMENT, nombre VARCHAR(150) NOT NULL, descripcion text NOT NULL, precio VARCHAR(100) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE programaColegio (id BIGINT AUTO_INCREMENT, titulo VARCHAR(150) NOT NULL, descripcion text NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE unidadTematica (id BIGINT AUTO_INCREMENT, idusuario BIGINT NOT NULL, titulo VARCHAR(150) NOT NULL, descripcion text NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idusuario_idx (idusuario), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE videoCapitulo (id BIGINT AUTO_INCREMENT, idcapitulo BIGINT NOT NULL, descripcion text NOT NULL, enlacevideo VARCHAR(255) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idcapitulo_idx (idcapitulo), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE videoContenidoPadresYProfesores (id BIGINT AUTO_INCREMENT, idcontenidopadresyprofesores BIGINT NOT NULL, descripcion text NOT NULL, enlacevideo VARCHAR(255) NOT NULL, soloaccesopremium TINYINT(1) DEFAULT '0' NOT NULL, soloaccesologado TINYINT(1) DEFAULT '0' NOT NULL, borrado TINYINT(1) DEFAULT '0' NOT NULL, activo TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX idcontenidopadresyprofesores_idx (idcontenidopadresyprofesores), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), espremiun TINYINT(1) DEFAULT '0', is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE capitulo ADD CONSTRAINT capitulo_idepisodio_episodio_id FOREIGN KEY (idepisodio) REFERENCES episodio(id);
ALTER TABLE comentario ADD CONSTRAINT comentario_idusuario_sf_guard_user_id FOREIGN KEY (idusuario) REFERENCES sf_guard_user(id);
ALTER TABLE comentario ADD CONSTRAINT comentario_idunidadtematica_unidadTematica_id FOREIGN KEY (idunidadtematica) REFERENCES unidadTematica(id);
ALTER TABLE contenido ADD CONSTRAINT contenido_idusuario_sf_guard_user_id FOREIGN KEY (idusuario) REFERENCES sf_guard_user(id);
ALTER TABLE contenido ADD CONSTRAINT contenido_idcategoriacontenido_categoriaContenido_id FOREIGN KEY (idcategoriacontenido) REFERENCES categoriaContenido(id);
ALTER TABLE contenidoPadresYProfesores ADD CONSTRAINT contenidoPadresYProfesores_idepisodio_episodio_id FOREIGN KEY (idepisodio) REFERENCES episodio(id);
ALTER TABLE elExperto ADD CONSTRAINT elExperto_idepisodio_episodio_id FOREIGN KEY (idepisodio) REFERENCES episodio(id);
ALTER TABLE episodio ADD CONSTRAINT episodio_idunidadtematica_unidadTematica_id FOREIGN KEY (idunidadtematica) REFERENCES unidadTematica(id);
ALTER TABLE fotografiaCapitulo ADD CONSTRAINT fotografiaCapitulo_idcapitulo_capitulo_id FOREIGN KEY (idcapitulo) REFERENCES capitulo(id);
ALTER TABLE fotografiaContenidoPadresYProfesores ADD CONSTRAINT fici FOREIGN KEY (idcontenidopadresyprofesores) REFERENCES contenidoPadresYProfesores(id);
ALTER TABLE fotografiaProducto ADD CONSTRAINT fotografiaProducto_idproducto_producto_id FOREIGN KEY (idproducto) REFERENCES producto(id);
ALTER TABLE fotografiaProgramaColegio ADD CONSTRAINT fotografiaProgramaColegio_idprogramacolegio_programaColegio_id FOREIGN KEY (idprogramacolegio) REFERENCES programaColegio(id);
ALTER TABLE juegoEpisodio ADD CONSTRAINT juegoEpisodio_idepisodio_episodio_id FOREIGN KEY (idepisodio) REFERENCES episodio(id);
ALTER TABLE unidadTematica ADD CONSTRAINT unidadTematica_idusuario_sf_guard_user_id FOREIGN KEY (idusuario) REFERENCES sf_guard_user(id);
ALTER TABLE videoCapitulo ADD CONSTRAINT videoCapitulo_idcapitulo_capitulo_id FOREIGN KEY (idcapitulo) REFERENCES capitulo(id);
ALTER TABLE videoContenidoPadresYProfesores ADD CONSTRAINT vici FOREIGN KEY (idcontenidopadresyprofesores) REFERENCES contenidoPadresYProfesores(id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
