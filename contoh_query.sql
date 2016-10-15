SELECT  

count(if(month(tanggal)=1,1,null) ) as bulan_1,
count(if(month(tanggal)=2,1,null) ) as bulan_2,
count(if(month(tanggal)=3,1,null) ) as bulan_3,
count(if(month(tanggal)=4,1,null) ) as bulan_4,
count(if(month(tanggal)=5,1,null) ) as bulan_5,
count(if(month(tanggal)=6,1,null) ) as bulan_6,
count(if(month(tanggal)=7,1,null) ) as bulan_7,
count(if(month(tanggal)=8,1,null) ) as bulan_8,
count(if(month(tanggal)=9,1,null) ) as bulan_9,
count(if(month(tanggal)=10,1,null) ) as bulan_10,
count(if(month(tanggal)=11,1,null) ) as bulan_11,
count(if(month(tanggal)=12,1,null) ) as bulan_12

FROM lap_a
where year(tanggal) = 2016