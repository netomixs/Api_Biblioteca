-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2024 a las 01:37:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4
use  biblioteca;
 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Autor_Actualizar` (IN `Param_Id` INT, IN `Param_Codigo` VARCHAR(255))   UPDATE `autor` SET  `Codigo`=@P1 WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Autor_Eliminar` (IN `Param_Id` INT)   DELETE  FROM autor WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Autor_Insertar` (IN `Param_Id_Persona` INT, IN `Param_Codigo` VARCHAR(255))   BEGIN 
INSERT INTO `autor`( `Id_Persona`, `Codigo`)
VALUES (@P0,@P1);
SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Autor_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM autor WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Autor_Seleccionar_Todos` ()   SELECT * FROM autor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Editorial_Actualizar` (IN `Param_Id` INT, IN `Param_Nombre` INT, IN `Param_Pais` INT)   UPDATE `editorial` SET
`Nombre`=@P1,`Pais`=@P 
WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Editorial_Eliminar` (IN `Param_Id` INT)   DELETE FROM editorial WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Editorial_Insertar` (IN `Param_Nombre` VARCHAR(255), IN `Param_Pais` VARCHAR(255))   BEGIN 
INSERT INTO `editorial`(`Nombre`, `Pais` )
VALUES (@P0,@P1);
SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Editorial_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM editorial WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Editorial_Seleccionar_Todos` ()   SELECT * FROM editorial$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Genero_Actualizar` (IN `Param_Id` INT, IN `Param_Codigo` VARCHAR(255), IN `Param_Nombre` VARCHAR(255))   UPDATE `genero` SET `Codigo`=@P1,`Nombre`=@P2 WHERE @P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Genero_Eliminar` (IN `Param_Id` INT)   DELETE FROM `genero` WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Genero_Insertar` (IN `Param_Codigo` VARCHAR(255), IN `Param_Nombre` VARCHAR(255))   BEGIN
INSERT INTO `genero`( `Codigo`, `Nombre`) 
VALUES (@P0,@P1);
SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Genero_Seleccioanr_Todos` ()   SELECT * FROM genero$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Genero_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM `genero` WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Lector_Actualizar` (IN `Param_Id` INT, IN `Param_UDI` CHAR(18))   UPDATE `lector` SET `UDI`=@P1 WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Lector_Eliminar` (IN `Param_Id` INT)   DELETE FROM lector WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Lector_Insertar` (IN `Param_UDI` CHAR(18), IN `Param_Id_Persona` INT, IN `Fecha_Inscripcion` DATE)   BEGIN
INSERT INTO `lector`( `UDI`, `Id_Persona`, `Fecha_Inscripcion`) 
VALUES (@P0,@P1,@P2);
SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Lector_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM lector WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Lector_Seleccionar_Todos` ()   SELECT * FROM lector$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Libro_Actualizar` (IN `Param_Id` INT, IN `Param_ISBN` VARCHAR(13), IN `Param_Titulo` VARCHAR(255), IN `Param_Descripcion` TEXT, IN `Param_Fecha_Publicacion` DATE, IN `Param_Feha_Adquicicion` DATETIME, IN `Param_Existencias` INT, IN `Param_Es_Prestable` BOOLEAN, IN `Param_Imagen` TEXT, IN `Param_Id_Tipo` INT, IN `Param_Id_Editorial` INT, IN `Param_Codigo` VARCHAR(255))   UPDATE `libro` SET `ISBN`=@P1,`Titulo`=@P2,`Descripcion`=@P3,`Fecha_Publicacion`=@P4,`Feha_Adquicicion`=@P5,`Existencias`=@P6,`Es_Prestable`=@P7,`Imagen`=@P8,`Id_Tipo`=@P9,`Id_Editorial`=@P10,`Codigo`=@P11 WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Libro_Insertar` (IN `Param_ISBN` VARCHAR(13), IN `Param_Titulo` VARCHAR(255), IN `Param_Descripcion` TEXT, IN `Param_Fecha_Publicacion` DATE, IN `Param_Feha_Adquicicion` DATETIME, IN `Param_Existencias` INT, IN `Param_Es_Prestable` BOOLEAN, IN `Param_Imagen` TEXT, IN `Param_Id_Tipo` INT, IN `Param_Id_Editorial` INT, IN `Param_Codigo` VARCHAR(255))   BEGIN
INSERT INTO `libro`
(`ISBN`, `Titulo`, `Descripcion`
 , `Fecha_Publicacion`, `Feha_Adquicicion`,
 `Existencias`, `Es_Prestable`, `Imagen`,
 `Id_Tipo`, `Id_Editorial`, `Codigo`) VALUES
 (@P0,@P1,@P2,@P3,@P4,@P5,@P6,@P7,@P8,@P9,@P10,@P1);
 SELECT LAST_INSERT_ID() as Id_Result;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Persona_Actualizar` (IN `Param_Id` INT, IN `Param_Nombre` VARCHAR(255), IN `Param_Apellido_P` VARCHAR(255), IN `Param_Apellido_M` VARCHAR(255), IN `Param_Naciemiento` DATE, IN `Param_Sexo` CHAR(1))   BEGIN
UPDATE `personas` SET `Nombre`=@P1,`Apellido_P`=@P2,`Apellido_M`=@P3,`Nacimiento`=@P4,
`Sexo`=@P5 WHERE id=@P0;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Persona_Eliminar` (IN `Param_Id` INT)   DELETE FROM personas WHERE id =@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Persona_Insertar` (IN `Param_Nombre` VARCHAR(255), IN `Param_Apellido_P` VARCHAR(255), IN `Param_Apellido_M` VARCHAR(255), IN `Param_Naciemiento` DATE, IN `Param_Sexo` CHAR(1))   BEGIN
INSERT INTO `personas`
(Nombre, Apellido_P, Apellido_M, Nacimiento, Sexo)
VALUES 
(@P0,@P1,@P2,@P3,@P4);
    SELECT LAST_INSERT_ID() as Id_Result;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Persona_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM personas WHERE id =@p0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Persona_Seleccionar_Todos` ()   SELECT * FROM personas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Prestamo_Actualizar` (IN `Param_Id` INT, IN `Param_Fecha_Inicio` DATETIME, IN `Param_Fecha_FIn` DATETIME, IN `Param_Fecha_Entrega` DATETIME, IN `Param_Id_Libro` INT, IN `Param_Id_Lector` INT, IN `Param_Id_Administrador` INT)   BEGIN
UPDATE `prestamo` SET  `Fecha_Inicio`=@P1,`Fecha_FIn`=@P2,`Fecha_Entrega`=@P3,`Id_Libro`=@P4,`Id_Lector`=@P5,`Id_Administrador`=@P6 WHERE id=@P0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Prestamo_Eliminar` (IN `Param_Id` INT)   DELETE FROM prestamo WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Prestamo_Insertar` (IN `Param_Fecha_Inicio` DATETIME, IN `Param_Fecha_FIn` DATETIME, IN `Param_Fecha_Entrega` DATETIME, IN `Param_Id_Libro` INT, IN `Param_Id_Lector` INT, IN `Param_Id_Administrador` INT)   BEGIN
INSERT INTO `prestamo`(  `Fecha_Inicio`, `Fecha_FIn`, `Fecha_Entrega`,
                       `Id_Libro`, `Id_Lector`, `Id_Administrador`) VALUES 
   (@P0,@P1,@P2,@P3,@P4,@P5);
    SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Prestamo_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM prestamo WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Prestamo_Seleccionar_Todos` ()   SELECT * FROM prestamo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Tipo_Actualizar` (IN `Param_Id` INT, IN `Param_Codigo` INT, IN `Param_Nombre` INT)   BEGIN
 UPDATE `tipo` SET  `Codigo`=@P1 ,`Nombre`=@P2  WHERE id=@P0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Tipo_Eliminar` (IN `Param_Id` INT)   DELETE FROM tipo WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Tipo_Insertar` (IN `Param_Codigo` INT, IN `Param_Nombre` INT)   BEGIN
INSERT INTO `tipo`(  `Codigo`, `Nombre`) 
VALUES ( @P0,@P1);
SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Tipo_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM tipo WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Tipo_Seleccionar_Todos` ()   SELECT * FROM tipo WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Usuarios_Seleccionar_Id` (IN `Param_Id` INT)   SELECT * FROM usuarios WHERE id =@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Usuario_Actualizar` (IN `Param_Id` INT, IN `Param_Usuario` VARCHAR(255), IN `Param_Password` TEXT, IN `Param_Fecha_Registro` DATETIME, IN `Param_Clave_Empleado` VARCHAR(255), IN `Param_Id_Persona` INT, IN `Param_Nivel` INT)   BEGIN
 UPDATE `usuarios` SET `Usuario`=@P1,`Password`=@P2,`Fecha_Registro`=@P3,`Clave_Empleado`=@P4,`Id_Persona`=@P5,`Nivel`=@P6 WHERE id=@P0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Usuario_Eliminar` (IN `Param_Id` INT)   DELETE FROM usuarios WHERE id=@P0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Usuario_Insertar` (IN `Param_Usuario` VARCHAR(255), IN `Param_Password` TEXT, IN `Param_Fecha_Registro` DATETIME, IN `Param_Clave_Empleado` VARCHAR(255), IN `Param_Id_Persona` INT, IN `Param_Nivel` INT)   BEGIN
INSERT INTO `usuarios`
(  `Usuario`, `Password`, `Fecha_Registro`, `Clave_Empleado`,
 `Id_Persona`, `Nivel`) 
VALUES (@P0,@P1,@P2,@P3,@P4,@P5);
 SELECT LAST_INSERT_ID() as Id_Result;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Sp_Usuario_Seleccionar_Todos` ()   SELECT * FROM usuarios$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `Id` int(11) NOT NULL,
  `Id_Persona` int(11) NOT NULL,
  `Codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `Nombre` varchar(255) NOT NULL,
  `Pais` varchar(255) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `Id` int(11) NOT NULL,
  `Codigo` char(3) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lector`
--

CREATE TABLE `lector` (
  `Id` int(11) NOT NULL,
  `UDI` char(18) NOT NULL,
  `Id_Persona` int(11) DEFAULT NULL,
  `Fecha_Inscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `Id` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha_Publicacion` date NOT NULL,
  `Feha_Adquicicion` datetime NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Es_Prestable` tinyint(1) NOT NULL,
  `Imagen` text NOT NULL,
  `Id_Tipo` int(11) DEFAULT NULL,
  `Id_Editorial` int(11) DEFAULT NULL,
  `Codigo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroxautor`
--

CREATE TABLE `libroxautor` (
  `Id` int(11) NOT NULL,
  `Id_Libro` int(11) NOT NULL,
  `Id_Autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroxgenero`
--

CREATE TABLE `libroxgenero` (
  `Id` int(11) NOT NULL,
  `Id_Libro` int(11) NOT NULL,
  `Id_Genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido_P` varchar(255) NOT NULL,
  `Apellido_M` varchar(255) DEFAULT NULL,
  `Nacimiento` date NOT NULL,
  `Sexo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Id`, `Nombre`, `Apellido_P`, `Apellido_M`, `Nacimiento`, `Sexo`) VALUES
(1, 'Ernesto', 'De Leon', 'Gallegos', '2002-12-04', 'H'),
(3, '0', 'as', 'asd', '0000-00-00', 'M'),
(4, '0', 'as', 'asd', '0000-00-00', 'M'),
(5, '0', 'as', 'asd', '0000-00-00', 'M'),
(6, '0', 'as', 'asd', '0000-00-00', 'M'),
(7, '0', 'as', 'asd', '0000-00-00', 'M'),
(8, '0', 'as', 'asd', '0000-00-00', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `Id` int(11) NOT NULL,
  `Fecha_Inicio` datetime NOT NULL,
  `Fecha_FIn` datetime NOT NULL,
  `Fecha_Entrega` datetime NOT NULL,
  `Id_Libro` int(11) DEFAULT NULL,
  `Id_Lector` int(11) DEFAULT NULL,
  `Id_Administrador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `Id` int(11) NOT NULL,
  `Codigo` char(3) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Password` text NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Clave_Empleado` varchar(255) NOT NULL,
  `Id_Persona` int(11) NOT NULL,
  `Nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Codigo` (`Codigo`),
  ADD KEY `autor_persona` (`Id_Persona`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `lector`
--
ALTER TABLE `lector`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Codigo` (`Codigo`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `libro_editorial` (`Id_Editorial`),
  ADD KEY `libro_tipo` (`Id_Tipo`);

--
-- Indices de la tabla `libroxautor`
--
ALTER TABLE `libroxautor`
  ADD PRIMARY KEY (`Id`),
  ADD KEY ` libroxautor_libro` (`Id_Libro`),
  ADD KEY ` libroxautor_autor` (`Id_Autor`);

--
-- Indices de la tabla `libroxgenero`
--
ALTER TABLE `libroxgenero`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `libroxgenero_libro` (`Id_Genero`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `prestamo_lector` (`Id_Lector`),
  ADD KEY `prestamo_libro` (`Id_Libro`),
  ADD KEY `prestamo_usuarios` (`Id_Administrador`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Clave_Empleado` (`Clave_Empleado`),
  ADD KEY `usuario_nivel` (`Nivel`) USING BTREE,
  ADD KEY `usuario_persona` (`Id_Persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lector`
--
ALTER TABLE `lector`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libroxautor`
--
ALTER TABLE `libroxautor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libroxgenero`
--
ALTER TABLE `libroxgenero`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autor`
--
ALTER TABLE `autor`
  ADD CONSTRAINT `autor_persona` FOREIGN KEY (`Id_Persona`) REFERENCES `personas` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_editorial` FOREIGN KEY (`Id_Editorial`) REFERENCES `editorial` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `libro_tipo` FOREIGN KEY (`Id_Tipo`) REFERENCES `tipo` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `libroxautor`
--
ALTER TABLE `libroxautor`
  ADD CONSTRAINT ` libroxautor_autor` FOREIGN KEY (`Id_Autor`) REFERENCES `autor` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT ` libroxautor_libro` FOREIGN KEY (`Id_Libro`) REFERENCES `libro` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libroxgenero`
--
ALTER TABLE `libroxgenero`
  ADD CONSTRAINT `libroxgenero_genero` FOREIGN KEY (`Id_Genero`) REFERENCES `genero` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libroxgenero_libro` FOREIGN KEY (`Id_Genero`) REFERENCES `libro` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_lector` FOREIGN KEY (`Id_Lector`) REFERENCES `lector` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_libro` FOREIGN KEY (`Id_Libro`) REFERENCES `libro` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_usuarios` FOREIGN KEY (`Id_Administrador`) REFERENCES `usuarios` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_nivel` FOREIGN KEY (`Nivel`) REFERENCES `nivel` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_persona` FOREIGN KEY (`Id_Persona`) REFERENCES `personas` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
