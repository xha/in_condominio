USE [AEALQUILER]
GO
SET IDENTITY_INSERT [dbo].[ISCO_Rol] ON 

INSERT [dbo].[ISCO_Rol] ([id_rol], [descripcion], [activo]) VALUES (1, N'En Espera', 1)
INSERT [dbo].[ISCO_Rol] ([id_rol], [descripcion], [activo]) VALUES (2, N'Usuario', 1)
INSERT [dbo].[ISCO_Rol] ([id_rol], [descripcion], [activo]) VALUES (3, N'Administrador', 1)
SET IDENTITY_INSERT [dbo].[ISCO_Rol] OFF
SET IDENTITY_INSERT [dbo].[ISCO_Pregunta] ON 

INSERT [dbo].[ISCO_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (1, N'Lugar de Nacimiento', 1)
INSERT [dbo].[ISCO_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (2, N'Segundo nombre de su Padre', 1)
INSERT [dbo].[ISCO_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (3, N'Segundo nombre de su Madre', 1)
INSERT [dbo].[ISCO_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (4, N'Héroe de infancia', 1)
INSERT [dbo].[ISCO_Pregunta] ([id_pregunta], [descripcion], [activo]) VALUES (5, N'Lugar de Luna de miel', 1)
SET IDENTITY_INSERT [dbo].[ISCO_Pregunta] OFF
SET IDENTITY_INSERT [dbo].[ISCO_Usuario] ON 

INSERT [dbo].[ISCO_Usuario] ([id_usuario], [usuario], [correo], [cedula], [clave], [nombre], [apellido], [sexo], [respuesta_seguridad], [fecha_registro], [telefono], [activo], [id_rol], [id_pregunta], [CodUbic]) VALUES (1, N'001', N'nada@nada.com', N'123456', N'9df3bb42df815f39041a621f7282a475', N'Innova', N'Administrador', N'M', N'CCS', CAST(N'2017-10-22 23:38:36.063' AS DateTime), NULL, 1, 3, 1, N'01')
SET IDENTITY_INSERT [dbo].[ISCO_Usuario] OFF
SET IDENTITY_INSERT [dbo].[ISCO_ALICUOTA] ON 

INSERT [dbo].[ISCO_ALICUOTA] ([id_alicuota], [CodClie], [id_ubicacion], [id_piso], [descripcion], [metro], [porcentaje], [tipo_alquiler], [monto_alquiler], [activo], [porcentaje_alquiler], [alquiler]) VALUES (1, N'V10515600', 1, 1, N'PPD-2-7', CAST(10.00 AS Numeric(5, 2)), CAST(100.00 AS Numeric(5, 2)), 0, CAST(35000.00 AS Numeric(12, 2)), 1, CAST(0.00 AS Numeric(12, 2)), 1)
SET IDENTITY_INSERT [dbo].[ISCO_ALICUOTA] OFF
SET IDENTITY_INSERT [dbo].[ISCO_Correl] ON 

INSERT [dbo].[ISCO_Correl] ([id_correl], [canon]) VALUES (1, CAST(20000.00 AS Numeric(12, 2)))
SET IDENTITY_INSERT [dbo].[ISCO_Correl] OFF
SET IDENTITY_INSERT [dbo].[ISCO_PISO] ON 

INSERT [dbo].[ISCO_PISO] ([id_piso], [nombre], [activo]) VALUES (1, N'Planta Baja', 1)
SET IDENTITY_INSERT [dbo].[ISCO_PISO] OFF
SET IDENTITY_INSERT [dbo].[ISCO_UBICACION] ON 

INSERT [dbo].[ISCO_UBICACION] ([id_ubicacion], [nombre], [activo]) VALUES (1, N'Central', 1)
SET IDENTITY_INSERT [dbo].[ISCO_UBICACION] OFF
