--
-- Estructura de tabla para la tabla `ad_inventarios`
--

CREATE TABLE `ad_inventarios` (
  `id_auditoria` int(11) NOT NULL,
  `id_inventario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `accion` enum('INSERT','UPDATE') NOT NULL,
  `datos_anteriores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_anteriores`)),
  `datos_nuevos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_nuevos`)),
  `usuario_responsable` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_pedidos`
--

CREATE TABLE `ad_pedidos` (
  `id_ad` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `accion` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `datos_anteriores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_anteriores`)),
  `datos_nuevos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_nuevos`)),
  `usuario_responsable` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_pedidos_detalles`
--

CREATE TABLE `ad_pedidos_detalles` (
  `id_ad` int(11) NOT NULL,
  `id_detalle` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `accion` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `datos_anteriores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_anteriores`)),
  `datos_nuevos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_nuevos`)),
  `usuario_responsable` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_productos`
--

CREATE TABLE `ad_productos` (
  `id_auditoria` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `accion` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `datos_anteriores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_anteriores`)),
  `datos_nuevos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_nuevos`)),
  `usuario_responsable` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_trk_pedidos`
--

CREATE TABLE `ad_trk_pedidos` (
  `id_trk` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `usuario_responsable` varchar(150) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ad_usuarios`
--

CREATE TABLE `ad_usuarios` (
  `id_ad` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `accion` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `datos_anteriores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_anteriores`)),
  `datos_nuevos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_nuevos`)),
  `usuario_responsable` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos_detalle`
--

CREATE TABLE `carritos_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_pedido`
--

CREATE TABLE `estados_pedido` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE `imagenes_productos` (
  `id_imagen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `inventarios`
--
DELIMITER $$
CREATE TRIGGER `tr_inventarios_insert` AFTER INSERT ON `inventarios` FOR EACH ROW BEGIN
    INSERT INTO ad_inventarios (id_inventario, id_producto, accion, datos_nuevos)
    VALUES (
        NEW.id_inventario,
        NEW.id_producto,
        'INSERT',
        JSON_OBJECT(
            'stock', NEW.stock
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_inventarios_update` BEFORE UPDATE ON `inventarios` FOR EACH ROW BEGIN
    INSERT INTO ad_inventarios (
        id_inventario,
        id_producto,
        accion,
        datos_anteriores,
        datos_nuevos
    )
    VALUES (
        OLD.id_inventario,
        OLD.id_producto,
        'UPDATE',
        JSON_OBJECT(
            'stock', OLD.stock
        ),
        JSON_OBJECT(
            'stock', NEW.stock
        )
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT 0.00,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `tr_pedidos_delete` BEFORE DELETE ON `pedidos` FOR EACH ROW BEGIN
    INSERT INTO ad_pedidos (
        id_pedido,
        accion,
        datos_anteriores
    )
    VALUES (
        OLD.id_pedido,
        'DELETE',
        JSON_OBJECT(
            'id_cliente', OLD.id_cliente,
            'id_estado', OLD.id_estado,
            'total', OLD.total
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_pedidos_insert` AFTER INSERT ON `pedidos` FOR EACH ROW BEGIN
    INSERT INTO ad_pedidos (id_pedido, accion, datos_nuevos)
    VALUES (
        NEW.id_pedido,
        'INSERT',
        JSON_OBJECT(
            'id_cliente', NEW.id_cliente,
            'id_estado', NEW.id_estado,
            'total', NEW.total
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_pedidos_update` BEFORE UPDATE ON `pedidos` FOR EACH ROW BEGIN
    INSERT INTO ad_pedidos (
        id_pedido,
        accion,
        datos_anteriores,
        datos_nuevos
    )
    VALUES (
        OLD.id_pedido,
        'UPDATE',
        JSON_OBJECT(
            'id_cliente', OLD.id_cliente,
            'id_estado', OLD.id_estado,
            'total', OLD.total
        ),
        JSON_OBJECT(
            'id_cliente', NEW.id_cliente,
            'id_estado', NEW.id_estado,
            'total', NEW.total
        )
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_detalles`
--

CREATE TABLE `pedidos_detalles` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `pedidos_detalles`
--
DELIMITER $$
CREATE TRIGGER `tr_pedidos_detalles_delete` BEFORE DELETE ON `pedidos_detalles` FOR EACH ROW BEGIN
    INSERT INTO ad_pedidos_detalles (
        id_detalle,
        id_pedido,
        id_producto,
        accion,
        datos_anteriores
    )
    VALUES (
        OLD.id_detalle,
        OLD.id_pedido,
        OLD.id_producto,
        'DELETE',
        JSON_OBJECT(
            'cantidad', OLD.cantidad,
            'precio_unitario', OLD.precio_unitario
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_pedidos_detalles_insert` AFTER INSERT ON `pedidos_detalles` FOR EACH ROW BEGIN
    INSERT INTO ad_pedidos_detalles (
        id_detalle, id_pedido, id_producto, accion, datos_nuevos
    )
    VALUES (
        NEW.id_detalle,
        NEW.id_pedido,
        NEW.id_producto,
        'INSERT',
        JSON_OBJECT(
            'cantidad', NEW.cantidad,
            'precio_unitario', NEW.precio_unitario
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_pedidos_detalles_update` BEFORE UPDATE ON `pedidos_detalles` FOR EACH ROW BEGIN
    INSERT INTO ad_pedidos_detalles (
        id_detalle,
        id_pedido,
        id_producto,
        accion,
        datos_anteriores,
        datos_nuevos
    )
    VALUES (
        OLD.id_detalle,
        OLD.id_pedido,
        OLD.id_producto,
        'UPDATE',
        JSON_OBJECT(
            'cantidad', OLD.cantidad,
            'precio_unitario', OLD.precio_unitario
        ),
        JSON_OBJECT(
            'cantidad', NEW.cantidad,
            'precio_unitario', NEW.precio_unitario
        )
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `tr_productos_delete` BEFORE DELETE ON `productos` FOR EACH ROW INSERT INTO ad_productos (id_producto, accion, datos_anteriores)
VALUES (
    OLD.id_producto,
    'DELETE',
    JSON_OBJECT(
        'nombre', OLD.nombre,
        'descripcion', OLD.descripcion,
        'precio', OLD.precio,
        'id_subcategoria', OLD.id_subcategoria
    )
)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_productos_insert` AFTER INSERT ON `productos` FOR EACH ROW INSERT INTO ad_productos (id_producto, accion, datos_nuevos)
VALUES (
    NEW.id_producto,
    'INSERT',
    JSON_OBJECT(
        'nombre', NEW.nombre,
        'descripcion', NEW.descripcion,
        'precio', NEW.precio,
        'id_subcategoria', NEW.id_subcategoria
    )
)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_productos_update` BEFORE UPDATE ON `productos` FOR EACH ROW INSERT INTO ad_productos (id_producto, accion, datos_anteriores, datos_nuevos)
VALUES (
    OLD.id_producto,
    'UPDATE',
    JSON_OBJECT(
        'nombre', OLD.nombre,
        'descripcion', OLD.descripcion,
        'precio', OLD.precio,
        'id_subcategoria', OLD.id_subcategoria
    ),
    JSON_OBJECT(
        'nombre', NEW.nombre,
        'descripcion', NEW.descripcion,
        'precio', NEW.precio,
        'id_subcategoria', NEW.id_subcategoria
    )
)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `tr_usuarios_delete` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO ad_usuarios (
        id_usuario,
        accion,
        datos_anteriores
    )
    VALUES (
        OLD.id_usuario,
        'DELETE',
        JSON_OBJECT(
            'nombres', OLD.nombres,
            'apellidos', OLD.apellidos,
            'correo', OLD.correo,
            'telefono', OLD.telefono,
            'estado', OLD.estado
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_usuarios_insert` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO ad_usuarios (id_usuario, accion, datos_nuevos)
    VALUES (
        NEW.id_usuario,
        'INSERT',
        JSON_OBJECT(
            'nombres', NEW.nombres,
            'apellidos', NEW.apellidos,
            'correo', NEW.correo,
            'telefono', NEW.telefono,
            'estado', NEW.estado
        )
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_usuarios_update` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO ad_usuarios (
        id_usuario,
        accion,
        datos_anteriores,
        datos_nuevos
    )
    VALUES (
        OLD.id_usuario,
        'UPDATE',
        JSON_OBJECT(
            'nombres', OLD.nombres,
            'apellidos', OLD.apellidos,
            'correo', OLD.correo,
            'telefono', OLD.telefono,
            'estado', OLD.estado
        ),
        JSON_OBJECT(
            'nombres', NEW.nombres,
            'apellidos', NEW.apellidos,
            'correo', NEW.correo,
            'telefono', NEW.telefono,
            'estado', NEW.estado
        )
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_actividad_trabajadores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_actividad_trabajadores` (
`usuario_responsable` int(11)
,`nombres` varchar(100)
,`apellidos` varchar(100)
,`accion` varchar(6)
,`fecha` timestamp
,`tabla_afectada` varchar(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_productos_mas_vendidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_productos_mas_vendidos` (
`id_producto` int(11)
,`nombre` varchar(100)
,`total_vendido` decimal(32,0)
,`total_generado` decimal(42,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_ventas_por_categoria`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_ventas_por_categoria` (
`categoria` varchar(100)
,`total_generado` decimal(42,2)
,`unidades_vendidas` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_ventas_por_mes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_ventas_por_mes` (
`mes` varchar(7)
,`total_pedidos` bigint(21)
,`total_vendido` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_actividad_trabajadores`
--
DROP TABLE IF EXISTS `vw_actividad_trabajadores`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_actividad_trabajadores`  AS SELECT `au`.`usuario_responsable` AS `usuario_responsable`, `u`.`nombres` AS `nombres`, `u`.`apellidos` AS `apellidos`, `au`.`accion` AS `accion`, `au`.`fecha` AS `fecha`, 'productos' AS `tabla_afectada` FROM (`ad_productos` `au` join `usuarios` `u` on(`au`.`usuario_responsable` = `u`.`id_usuario`))union all select `ai`.`usuario_responsable` AS `usuario_responsable`,`u`.`nombres` AS `nombres`,`u`.`apellidos` AS `apellidos`,`ai`.`accion` AS `accion`,`ai`.`fecha` AS `fecha`,'inventarios' AS `inventarios` from (`ad_inventarios` `ai` join `usuarios` `u` on(`ai`.`usuario_responsable` = `u`.`id_usuario`)) union all select `ap`.`usuario_responsable` AS `usuario_responsable`,`u`.`nombres` AS `nombres`,`u`.`apellidos` AS `apellidos`,`ap`.`accion` AS `accion`,`ap`.`fecha` AS `fecha`,'pedidos' AS `pedidos` from (`ad_pedidos` `ap` join `usuarios` `u` on(`ap`.`usuario_responsable` = `u`.`id_usuario`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_productos_mas_vendidos`
--
DROP TABLE IF EXISTS `vw_productos_mas_vendidos`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_productos_mas_vendidos`  AS SELECT `pd`.`id_producto` AS `id_producto`, `pr`.`nombre` AS `nombre`, sum(`pd`.`cantidad`) AS `total_vendido`, sum(`pd`.`cantidad` * `pd`.`precio_unitario`) AS `total_generado` FROM (`pedidos_detalles` `pd` join `productos` `pr` on(`pd`.`id_producto` = `pr`.`id_producto`)) GROUP BY `pd`.`id_producto`, `pr`.`nombre` ORDER BY sum(`pd`.`cantidad`) DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_ventas_por_categoria`
--
DROP TABLE IF EXISTS `vw_ventas_por_categoria`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_ventas_por_categoria`  AS SELECT `c`.`nombre` AS `categoria`, sum(`pd`.`cantidad` * `pd`.`precio_unitario`) AS `total_generado`, sum(`pd`.`cantidad`) AS `unidades_vendidas` FROM (((`pedidos_detalles` `pd` join `productos` `p` on(`pd`.`id_producto` = `p`.`id_producto`)) join `subcategorias` `s` on(`p`.`id_subcategoria` = `s`.`id_subcategoria`)) join `categorias` `c` on(`s`.`id_categoria` = `c`.`id_categoria`)) GROUP BY `c`.`nombre` ORDER BY sum(`pd`.`cantidad` * `pd`.`precio_unitario`) DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_ventas_por_mes`
--
DROP TABLE IF EXISTS `vw_ventas_por_mes`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_ventas_por_mes`  AS SELECT date_format(`p`.`creado_en`,'%Y-%m') AS `mes`, count(`p`.`id_pedido`) AS `total_pedidos`, sum(`p`.`total`) AS `total_vendido` FROM `pedidos` AS `p` GROUP BY date_format(`p`.`creado_en`,'%Y-%m') ORDER BY date_format(`p`.`creado_en`,'%Y-%m') ASC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ad_inventarios`
--
ALTER TABLE `ad_inventarios`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `usuario_responsable` (`usuario_responsable`);

--
-- Indices de la tabla `ad_pedidos`
--
ALTER TABLE `ad_pedidos`
  ADD PRIMARY KEY (`id_ad`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `usuario_responsable` (`usuario_responsable`);

--
-- Indices de la tabla `ad_pedidos_detalles`
--
ALTER TABLE `ad_pedidos_detalles`
  ADD PRIMARY KEY (`id_ad`),
  ADD KEY `id_detalle` (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `usuario_responsable` (`usuario_responsable`);

--
-- Indices de la tabla `ad_productos`
--
ALTER TABLE `ad_productos`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `usuario_responsable` (`usuario_responsable`);

--
-- Indices de la tabla `ad_trk_pedidos`
--
ALTER TABLE `ad_trk_pedidos`
  ADD PRIMARY KEY (`id_trk`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `ad_usuarios`
--
ALTER TABLE `ad_usuarios`
  ADD PRIMARY KEY (`id_ad`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `usuario_responsable` (`usuario_responsable`);

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `carritos_detalle`
--
ALTER TABLE `carritos_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_carrito` (`id_carrito`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `estados_pedido`
--
ALTER TABLE `estados_pedido`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id_inventario`),
  ADD UNIQUE KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `pedidos_detalles`
--
ALTER TABLE `pedidos_detalles`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_subcategoria` (`id_subcategoria`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ad_inventarios`
--
ALTER TABLE `ad_inventarios`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ad_pedidos`
--
ALTER TABLE `ad_pedidos`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ad_pedidos_detalles`
--
ALTER TABLE `ad_pedidos_detalles`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ad_productos`
--
ALTER TABLE `ad_productos`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ad_trk_pedidos`
--
ALTER TABLE `ad_trk_pedidos`
  MODIFY `id_trk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ad_usuarios`
--
ALTER TABLE `ad_usuarios`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carritos_detalle`
--
ALTER TABLE `carritos_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_pedido`
--
ALTER TABLE `estados_pedido`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos_detalles`
--
ALTER TABLE `pedidos_detalles`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ad_inventarios`
--
ALTER TABLE `ad_inventarios`
  ADD CONSTRAINT `ad_inventarios_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `inventarios` (`id_inventario`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_inventarios_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_inventarios_ibfk_3` FOREIGN KEY (`usuario_responsable`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ad_pedidos`
--
ALTER TABLE `ad_pedidos`
  ADD CONSTRAINT `ad_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_pedidos_ibfk_2` FOREIGN KEY (`usuario_responsable`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ad_pedidos_detalles`
--
ALTER TABLE `ad_pedidos_detalles`
  ADD CONSTRAINT `ad_pedidos_detalles_ibfk_1` FOREIGN KEY (`id_detalle`) REFERENCES `pedidos_detalles` (`id_detalle`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_pedidos_detalles_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_pedidos_detalles_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_pedidos_detalles_ibfk_4` FOREIGN KEY (`usuario_responsable`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ad_productos`
--
ALTER TABLE `ad_productos`
  ADD CONSTRAINT `ad_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_productos_ibfk_2` FOREIGN KEY (`usuario_responsable`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ad_trk_pedidos`
--
ALTER TABLE `ad_trk_pedidos`
  ADD CONSTRAINT `ad_trk_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `ad_trk_pedidos_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados_pedido` (`id_estado`);

--
-- Filtros para la tabla `ad_usuarios`
--
ALTER TABLE `ad_usuarios`
  ADD CONSTRAINT `ad_usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `ad_usuarios_ibfk_2` FOREIGN KEY (`usuario_responsable`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `carritos_detalle`
--
ALTER TABLE `carritos_detalle`
  ADD CONSTRAINT `carritos_detalle_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carritos` (`id_carrito`) ON DELETE CASCADE,
  ADD CONSTRAINT `carritos_detalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados_pedido` (`id_estado`);

--
-- Filtros para la tabla `pedidos_detalles`
--
ALTER TABLE `pedidos_detalles`
  ADD CONSTRAINT `pedidos_detalles_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_detalles_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE;
COMMIT;
