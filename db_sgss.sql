USE [SGSS]
GO
/****** Object:  Table [dbo].[m_master_data_vendor]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_master_data_vendor](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[vendor_code] [nvarchar](50) NULL,
	[category] [nvarchar](50) NULL,
	[vendor_name] [nvarchar](50) NULL,
	[rating] [nvarchar](50) NULL,
	[time_add] [datetime] NULL,
	[time_update] [datetime] NULL,
	[est_lead_time] [decimal](18, 0) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[m_master_data_material]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_master_data_material](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[item_code] [varchar](50) NULL,
	[item_name] [varchar](50) NULL,
	[factory] [varchar](50) NULL,
	[uom] [varchar](50) NULL,
	[lt_pr_po] [decimal](18, 0) NULL,
	[vendor_code] [varchar](50) NULL,
	[lot_size] [decimal](18, 0) NULL,
	[initial_value_stock] [varchar](50) NULL,
	[order_cycle] [decimal](18, 0) NULL,
	[initial_stock] [varchar](50) NULL,
	[lt_po_to_delivery] [varchar](50) NULL,
	[standart_safety_stock] [varchar](50) NULL,
	[initial_value_for_to_do] [varchar](50) NULL,
	[price_per_uom] [decimal](18, 0) NULL,
	[price_equal_moq] [decimal](18, 0) NULL,
	[place_to_buy] [varchar](50) NULL,
	[link] [text] NULL,
	[time_add] [datetime] NULL,
	[time_update] [datetime] NULL,
	[moq] [int] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  View [dbo].[view_master_vendor]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_master_vendor]
AS
SELECT vendor.vendor_code, vendor.category, vendor.vendor_name, vendor.rating, material.item_name, material.uom, vendor.est_lead_time, material.price_per_uom, material.moq, material.moq * material.price_per_uom AS total_price, 
                  material.price_equal_moq, material.price_equal_moq / material.moq AS price_moq_divide_moq, (material.price_per_uom - material.price_equal_moq / material.moq) / material.price_per_uom * 100 AS saving, material.place_to_buy, 
                  material.link
FROM     dbo.m_master_data_material AS material INNER JOIN
                  dbo.m_master_data_vendor AS vendor ON vendor.vendor_code = material.vendor_code
GO
/****** Object:  Table [dbo].[m_employee]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_employee](
	[nip] [nchar](10) NULL,
	[nama] [nchar](10) NULL,
	[email] [nchar](10) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[m_master_stock_card_calculation]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_master_stock_card_calculation](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[item_code] [varchar](50) NULL,
	[week] [varchar](50) NULL,
	[week_count_start] [varchar](50) NULL,
	[week_count_end] [varchar](50) NULL,
	[time_add] [datetime] NULL,
	[time_update] [datetime] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[m_role]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_role](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[role] [nchar](10) NULL,
	[role_desc] [nchar](10) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[m_user]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_user](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](50) NULL,
	[password] [nvarchar](50) NULL,
	[full_name] [nvarchar](50) NULL,
	[email] [nvarchar](50) NULL,
	[phone] [nvarchar](50) NULL,
	[photo] [nvarchar](50) NULL,
	[role_id] [int] NULL,
	[nip] [nvarchar](50) NULL,
	[role] [nvarchar](50) NULL,
	[status] [nvarchar](50) NULL,
	[time_add] [datetime] NULL,
	[time_update] [datetime] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[t_stock_card_calculation_log]    Script Date: 18/02/2025 14:56:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[t_stock_card_calculation_log](
	[id] [int] NULL,
	[item_code] [varchar](50) NULL,
	[week] [varchar](50) NULL,
	[reason] [varchar](50) NULL,
	[user_id] [varchar](50) NULL,
	[username] [varchar](50) NULL,
	[timestamp] [datetime] NULL,
	[time_add] [datetime] NULL,
	[time_update] [datetime] NULL
) ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[40] 4[20] 2[20] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "material"
            Begin Extent = 
               Top = 7
               Left = 48
               Bottom = 170
               Right = 290
            End
            DisplayFlags = 280
            TopColumn = 0
         End
         Begin Table = "vendor"
            Begin Extent = 
               Top = 7
               Left = 338
               Bottom = 170
               Right = 532
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 11
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'view_master_vendor'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'view_master_vendor'
GO
