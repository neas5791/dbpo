SELECT 
  tbPurchaseOrder.po_number,
  tbSupplier.company,
  tbPurchaseOrder.po_date, 
  tbPurchaseLine.line, 
  tbStatus.status, 
  COALESCE(tbPurchaseLine.job,'') AS job,  
  COALESCE(tbPart.partnumber,''),
  COALESCE(tbPart.drawingnumber,''),
  tbPurchaseLine.qty,
  tbPurchaseLine.price,
  tbPurchaseLine.qty * tbPurchaseLine.price as cost
FROM
  tbPurchaseLine
JOIN tbPurchaseOrder ON tbPurchaseLine.purchaseid = tbPurchaseOrder.id
JOIN tbStatus ON tbPurchaseLine.statusid = tbStatus.id
JOIN tbSupplier ON  tbPurchaseOrder.supplierid = tbSupplier.id
JOIN tbPart ON tbPurchaseLine.partid = tbPart.id;