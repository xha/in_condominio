CREATE PROCEDURE [dbo].[ISCO_PROCESA_ALICUOTA]
	WITH ENCRYPTION 
AS 
	DECLARE @i_id int, @i_metro numeric(10,2), @i_total_metro numeric(10,2), @i_alicuota numeric(10,2), @salida int

  BEGIN
	BEGIN TRY
		BEGIN TRAN PAlicuota
		SELECT @i_total_metro = (SELECT sum(metro) FROM ISCO_ALICUOTA WHERE activo=1)

		DECLARE palicuota_Cursor CURSOR FOR  
		SELECT id_alicuota,metro FROM ISCO_ALICUOTA where activo=1;  
		OPEN palicuota_Cursor;  

		FETCH NEXT FROM palicuota_Cursor into @i_id,@i_metro
		WHILE @@FETCH_STATUS = 0
		BEGIN
			SET @i_alicuota = (@i_metro * 100) / @i_total_metro

			UPDATE ISCO_ALICUOTA SET porcentaje=@i_alicuota WHERE id_alicuota=@i_id;   
			FETCH NEXT FROM palicuota_Cursor into @i_id,@i_metro
		END

		CLOSE palicuota_Cursor;  
		DEALLOCATE palicuota_Cursor;
		COMMIT TRAN PAlicuota
		SET @salida = 1;
    END TRY
	BEGIN CATCH
		/*SELECT ERROR_NUMBER() AS errNumber
	       , ERROR_SEVERITY() AS errSeverity 
	       , ERROR_STATE() AS errState
	       , ERROR_PROCEDURE() AS errProcedure
	       , ERROR_LINE() AS errLine
	       , ERROR_MESSAGE() AS errMessage*/
		SET @salida = -1;
		ROLLBACK TRAN PAlicuota
	END CATCH
  END

  SELECT @salida as salida;	
GO
/**************************/
CREATE PROCEDURE [dbo].[ISCO_CONDOMINIO]
	@i_id nvarchar(20),
	@i_usuario nvarchar(20) WITH ENCRYPTION 
AS 
	DECLARE @i_numerod varchar(20), @i_codesta varchar(10), @i_codusua varchar(10),
	@i_codvend varchar(10), @i_codubic varchar(10), @i_descrip varchar(60), @i_codclie varchar(15),
	@i_direc1 varchar(60), @i_id3 varchar(25), @i_monto decimal(28,4), @i_mtotax decimal(28,4), 
	@i_tgravable decimal(28,4), @i_texento decimal(28,4), @i_costoprd decimal(28,4), @i_costosrv decimal(28,4), 
	@i_desctop decimal(28,4), @i_fechae datetime, @i_mtototal decimal(28,4), @i_contado decimal(28,4), @i_credito decimal(28,4), 
	@i_totalprd decimal(28,4), @i_totalsrv decimal(28,4),@i_serv bit,@x_codtax varchar(10),@x_tgravable decimal(28,4),
	@i_nota1 varchar(60), @i_nota2 varchar(60), @i_nota3 varchar(60), @i_nota4 varchar(60),
	@i_nota5 varchar(60), @i_nota6 varchar(60), @i_nota7 varchar(60), @i_nota8 varchar(60),
	@i_nota9 varchar(60), @i_pocentaje decimal(28,4), @i_calculo decimal(28,4), @i_linea int,
	@i_coditem varchar(15), @i_ditem varchar(40), @i_cantidad decimal(28,4), @i_titem decimal(28,4), @i_precio decimal(28,4), 
	@i_taxitem decimal(28,4), @i_refere varchar(40), @d_total decimal(28,4), @d_precio decimal(28,4), @d_tax decimal(28,4),
	@c_total decimal(28,4), @c_precio decimal(28,4), @c_tax decimal(28,4),	@c_tgravable decimal(28,4), @c_texento decimal(28,4), 
	@correl varchar(15), @prefijo varchar(15), @valor int, @salida int

SET @prefijo = CONCAT('CO',YEAR(GETDATE()));
SET @i_fechae = GETDATE();
SET @c_texento = 0;
SET @c_tgravable = 0;

SELECT @valor = (SELECT count(*) FROM SAFACT WHERE Notas10 = @i_id and TipoFac='F')
  IF (@valor = 0)
  BEGIN
	BEGIN TRY
		BEGIN TRAN Condominio
		DECLARE safact_Cursor CURSOR FOR  
		SELECT NumeroD,CodEsta,CodUsua,CodVend,CodUbic,Direc1,ID3,Monto,MtoTax,TGravable,TExento,CostoPrd,CostoSrv,DesctoP,FechaI,FechaE,
			FechaV,MtoTotal,Contado,Credito,TotalPrd,TotalSrv,Notas1,Notas2,Notas3,Notas4,Notas5,Notas6,Notas7,Notas8,Notas9
			FROM SAFACT WHERE NumeroD = @i_id and TipoFac='F';  
		OPEN safact_Cursor;  
		FETCH NEXT FROM safact_Cursor into @i_numerod,@i_codesta,@i_codusua,@i_codvend,@i_codubic,@i_direc1,@i_id3,@i_monto,@i_mtotax, 
		@i_tgravable,@i_texento,@i_costoprd,@i_costosrv,@i_desctop,@i_fechae,@i_fechae,@i_fechae,@i_mtototal,@i_contado,@i_credito,@i_totalprd,@i_totalsrv,
		@i_nota1,@i_nota2,@i_nota3,@i_nota4,@i_nota5,@i_nota6,@i_nota7,@i_nota8,@i_nota9

		DECLARE alicuota_Cursor cursor for
		SELECT s.CodClie,s.Direc1,s.Descrip,a.porcentaje,s.ID3 
			FROM ISCO_ALICUOTA a, SACLIE s 
			WHERE s.CodClie=a.CodClie
		OPEN alicuota_Cursor
		FETCH NEXT FROM alicuota_Cursor into @i_codclie,@i_direc1,@i_descrip,@i_pocentaje,@i_id3
		WHILE @@FETCH_STATUS = 0
		BEGIN
			SET @c_precio = 0;
			SET @c_tax = 0;
			SET @c_total = 0;
		
			INSERT INTO ISCO_CORRELATIVO(NumeroD,prefijo)
			VALUES (@i_id,@prefijo) 
			SET @correl=CONCAT(@prefijo,SCOPE_IDENTITY());

			INSERT INTO SAFACT(CodSucu,TipoFac,NumeroD,CodEsta,CodUsua,CodVend,CodUbic,CodClie,Descrip,Direc1,ID3,Monto,MtoTax,TGravable,TExento,CostoPrd,CostoSrv,DesctoP,FechaI,
					FechaE,FechaV,MtoTotal,Contado,Credito,TotalPrd,TotalSrv,Notas10,Factor) VALUES ('00000','F',@correl,@i_codesta,
					@i_codusua,@i_codvend,@i_codubic,@i_codclie,@i_descrip,@i_direc1,@i_id3,0,0,0,0,0,0,0,@i_fechae,@i_fechae,@i_fechae,0,0,0,0,0,@i_id,1);   
			/****************************************************** SAITEMFAC *********************************************************/
			DECLARE saitemfac_Cursor cursor for
			SELECT NroLinea,CodItem,Descrip1,Refere,Cantidad,TotalItem,Precio,MtoTax,EsServ 
				FROM SAITEMFAC
				WHERE NumeroD = @i_id and TipoFac='F';  
			OPEN saitemfac_Cursor
			FETCH NEXT FROM saitemfac_Cursor into @i_linea,@i_coditem,@i_ditem, @i_refere, @i_cantidad, @i_titem, @i_precio, @i_taxitem, @i_serv
			WHILE @@FETCH_STATUS = 0
			BEGIN
				SET @d_precio = (@i_precio*@i_pocentaje)/100;
				SET @d_total = (@i_titem*@i_pocentaje)/100;
				if (@i_taxitem>0) 
				  BEGIN
					SET @d_tax = (@i_taxitem*@i_pocentaje)/100;
					SET @c_tgravable = @c_tgravable + (@i_cantidad*@d_precio);
				  END
				ELSE
				  BEGIN
					SET @d_tax = 0;
					SET @c_texento = @c_texento + (@i_cantidad*@d_precio);
				  END;
				
				SET @c_precio = @c_precio + @d_precio
				SET @c_tax = @c_tax + @d_tax
				SET @c_total = @c_total + @d_total

				INSERT INTO SAITEMFAC(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,CodVend,Descrip1,Refere,Signo,CantMayor,Cantidad,TotalItem,Precio,MtoTax,PriceO,FechaE,EsServ)
						VALUES ('00000','F',@correl,@i_linea,0,@i_coditem,@i_codubic,@i_codvend,@i_ditem,@i_refere,1,@i_cantidad,@i_cantidad,@d_total,@d_precio,@d_tax,@d_precio,@i_fechae,@i_serv);   
				FETCH NEXT FROM saitemfac_Cursor into @i_linea,@i_coditem,@i_ditem, @i_refere, @i_cantidad, @i_titem, @i_precio, @i_taxitem, @i_serv
			END

			CLOSE saitemfac_Cursor;  
			DEALLOCATE saitemfac_Cursor; 
			/****************************************************** SATAXITF *********************************************************/
			DECLARE saitemfac_Cursor cursor for
			SELECT NroLinea,CodTaxs,CodItem,Monto,TGravable,MtoTax
				FROM SATAXITF
				WHERE NumeroD = @i_id and TipoFac='F';  
			OPEN saitemfac_Cursor
			FETCH NEXT FROM saitemfac_Cursor into @i_linea,@x_codtax,@i_coditem,@i_titem, @x_tgravable, @i_taxitem
			WHILE @@FETCH_STATUS = 0
			BEGIN
				SET @d_precio = (@x_tgravable*@i_pocentaje)/100;
				SET @d_total = (@i_titem*@i_pocentaje)/100;
			
				INSERT INTO SATAXITF(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodTaxs,Monto,TGravable,MtoTax)
						VALUES ('00000','F',@correl,@i_linea,0,@i_coditem,@x_codtax,@d_total,@d_precio,@i_taxitem);   
				FETCH NEXT FROM saitemfac_Cursor into @i_linea,@x_codtax,@i_coditem,@i_titem, @x_tgravable, @i_taxitem
			END

			CLOSE saitemfac_Cursor;  
			DEALLOCATE saitemfac_Cursor;
			/****************************************************** SATAXVTA *********************************************************/
			DECLARE saitemfac_Cursor cursor for
			SELECT sum(Monto) as Monto, sum(TGravable) as TGravable,CodTaxs,MtoTax
				FROM SATAXITF 
				WHERE TipoFac='F' and NumeroD=@correl
				group by CodTaxs,MtoTax
			OPEN saitemfac_Cursor
			FETCH NEXT FROM saitemfac_Cursor into @i_titem,@x_tgravable,@x_codtax,@i_taxitem
			WHILE @@FETCH_STATUS = 0
			BEGIN
				INSERT INTO SATAXVTA(CodSucu,TipoFac,NumeroD,CodTaxs,Monto,TGravable,MtoTax,EsReten)
						VALUES ('00000','F',@correl,@x_codtax,@i_titem,@x_tgravable,@i_taxitem,1);   
				FETCH NEXT FROM saitemfac_Cursor into @i_titem,@x_tgravable,@x_codtax,@i_taxitem
			END

			CLOSE saitemfac_Cursor;  
			DEALLOCATE saitemfac_Cursor;
			/*************************************************************************************************************************/
			UPDATE SAFACT 
				SET Monto=@c_precio, MtoTax=@c_tax,TGravable=@c_tgravable,TExento=@c_texento,MtoTotal=@c_total,Credito=@c_total,TotalPrd=@c_precio
				WHERE NumeroD=@correl and TipoFac='F'
			FETCH NEXT FROM alicuota_Cursor into @i_codclie,@i_direc1,@i_descrip,@i_pocentaje,@i_id3
			/*************************************************************************************************************************/
			INSERT INTO ISCO_PRESUPUESTOS(numerod,usuario) VALUES (@i_id,@i_usuario);
		END
		/****************************************************** UPDATE SAFACT *****************************************************/
		  
		CLOSE safact_Cursor;  
		DEALLOCATE safact_Cursor;  
		CLOSE alicuota_Cursor 
		DEALLOCATE alicuota_Cursor;
		COMMIT TRAN Condominio
		SET @salida = 1;
    END TRY
	BEGIN CATCH
		/*SELECT ERROR_NUMBER() AS errNumber
	       , ERROR_SEVERITY() AS errSeverity 
	       , ERROR_STATE() AS errState
	       , ERROR_PROCEDURE() AS errProcedure
	       , ERROR_LINE() AS errLine
	       , ERROR_MESSAGE() AS errMessage*/
		SET @salida = -1;
		ROLLBACK TRAN Condominio
	END CATCH
  END
  ELSE
	SET @salida = 0;
  SELECT @salida as salida;	
GO
/*********************************************************************************************/
CREATE PROCEDURE [dbo].[ISCO_ARRENDAMIENTO]
	@i_mes nvarchar(20),
	@i_codesta nvarchar(15),
	@i_codubic nvarchar(15),
	@i_codusua nvarchar(15) WITH ENCRYPTION 
AS 
	DECLARE @i_codclie varchar(15), @i_monto_alquiler numeric(12,2), @i_descrip varchar(60), 
	@i_direc1 varchar(60), @i_direc2 varchar(60), @salida int, @prefijo varchar(15), @i_fechae datetime,
	@c_texento numeric(12,2),@c_tgravable numeric(12,2), @correl varchar(15),
	@v_descrip varchar(40), @v_precio1 numeric(12,2), @v_codtax varchar(15),
	@d_tax varchar(15), @d_monto numeric(12,2), @v_monto numeric(12,2), @i int

SET @prefijo = CONCAT(@i_mes,YEAR(GETDATE()));
SET @i_fechae = GETDATE();
SET @c_texento = 0;
SET @c_tgravable = 0;
SET @i = 1;

	BEGIN TRY
		BEGIN TRAN Arrendamiento
		DECLARE vista_Cursor CURSOR FOR  
		SELECT a.CodClie,a.monto_alquiler,s.Descrip,s.Direc1,s.Direc2
			FROM SACLIE s, ISCO_ALICUOTA a
			WHERE s.CodClie=a.CodClie and a.alquiler=1 and a.activo=1 and 
			a.CodClie NOT IN (SELECT CodClie FROM SAFACT WHERE TipoFac='F' and Notas6=@i_mes and Notas7='AR');  
		
		OPEN vista_Cursor;  
		FETCH NEXT FROM vista_Cursor into @i_codclie,@i_monto_alquiler,@i_descrip,@i_direc1,@i_direc2
		WHILE @@FETCH_STATUS = 0
		BEGIN
		  IF (@i_monto_alquiler>0) 
		  BEGIN
			SET @correl = CONCAT(@prefijo,@i);

			INSERT INTO SAFACT(CodSucu,TipoFac,NumeroD,CodEsta,CodUsua,CodVend,CodUbic,CodClie,Descrip,Direc1,ID3,Monto,MtoTax,TGravable,TExento,CostoPrd,CostoSrv,DesctoP,FechaI,
					FechaE,FechaV,MtoTotal,Contado,Credito,TotalPrd,TotalSrv,Notas6,Notas7,Factor) VALUES ('00000','F',@correl,@i_codesta,
					@i_codusua,'001',@i_codubic,@i_codclie,@i_descrip,@i_direc1,@i_codclie,0,0,0,0,0,0,0,@i_fechae,@i_fechae,@i_fechae,0,0,0,0,0,@i_mes,'AR',1);   
			/****************************************************** SAITEMFAC *********************************************************/
			DECLARE saserv_Cursor cursor for
			SELECT s.Descrip,s.Precio1, t.CodTaxs, t.Monto
				FROM SASERV s
				LEFT JOIN SATAXSRV t on s.CodServ=t.CodServ
				WHERE s.CodServ='S00001';  
			OPEN saserv_Cursor
			FETCH NEXT FROM saserv_Cursor into @v_descrip,@v_precio1,@v_codtax,@v_monto
			WHILE @@FETCH_STATUS = 0
			BEGIN
				if (@v_codtax>0) 
				  BEGIN
					SET @d_tax = (@i_monto_alquiler*@v_monto)/100;
					SET @c_tgravable = @i_monto_alquiler;
					SET @d_monto = @d_tax + @i_monto_alquiler;
					
					INSERT INTO SATAXITF(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodTaxs,Monto,TGravable,MtoTax)
						VALUES ('00000','F',@correl,1,0,'S00001',@v_codtax,@d_monto,@d_monto,@d_tax); 
					
					INSERT INTO SATAXVTA(CodSucu,TipoFac,NumeroD,CodTaxs,Monto,TGravable,MtoTax,EsReten)
						VALUES ('00000','F',@correl,@v_codtax,'S00001',@c_tgravable,@d_tax,1);     
				  END
				ELSE
				  BEGIN
					SET @d_tax = 0;
					SET @c_texento = @i_monto_alquiler;
					SET @d_monto = @i_monto_alquiler;
				  END;
				
				INSERT INTO SAITEMFAC(CodSucu,TipoFac,NumeroD,NroLinea,NroLineaC,CodItem,CodUbic,CodVend,Descrip1,Refere,Signo,CantMayor,Cantidad,TotalItem,Precio,MtoTax,PriceO,FechaE,EsServ)
						VALUES ('00000','F',@correl,1,0,'S00001',@i_codubic,'001',@v_descrip,'S00001',1,1,1,@d_monto,@d_monto,@d_tax,@d_monto,@i_fechae,1);   
				FETCH NEXT FROM saserv_Cursor into @v_descrip,@v_precio1,@v_codtax,@v_monto
			END

			CLOSE saserv_Cursor;  
			DEALLOCATE saserv_Cursor; 
			/*************************************************************************************************************************/
			INSERT INTO ISCO_PRESUPUESTOS(numerod,usuario) VALUES (@correl,@i_codusua);
		  END

		  UPDATE SAFACT 
				SET Monto=@d_monto, MtoTax=@d_tax,TGravable=@c_tgravable,TExento=@c_texento,MtoTotal=@d_monto,Credito=@d_monto,TotalSrv=@i_monto_alquiler
				WHERE NumeroD=@correl and TipoFac='F'
		  SET @i = @i + 1
		  FETCH NEXT FROM vista_Cursor into @i_codclie,@i_monto_alquiler,@i_descrip,@i_direc1,@i_direc2
		END
		/****************************************************** UPDATE SAFACT *****************************************************/
		  
		CLOSE vista_Cursor;  
		DEALLOCATE vista_Cursor;  
		COMMIT TRAN Arrendamiento
		SET @salida = 1;
    END TRY
	BEGIN CATCH
		SELECT ERROR_NUMBER() AS errNumber
	       , ERROR_SEVERITY() AS errSeverity 
	       , ERROR_STATE() AS errState
	       , ERROR_PROCEDURE() AS errProcedure
	       , ERROR_LINE() AS errLine
	       , ERROR_MESSAGE() AS errMessage
		SET @salida = -1;
		ROLLBACK TRAN Arrendamiento
	END CATCH

  SELECT @salida as salida;	
GO
