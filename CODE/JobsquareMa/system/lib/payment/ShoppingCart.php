<?php

class SJB_ShoppingCart
{
	public static function addToShoppingCart($productInfo, $userSID)
	{
		self::deleteItemsFromCartByUserSID($userSID);
		return SJB_DB::query("INSERT INTO `shopping_cart` (`user_sid`, `product_info`) VALUES (?n, ?s)", $userSID, serialize($productInfo));
	}
	
	public static function getAllProductsByUserSID($userSID)
	{
		return SJB_DB::query("SELECT * FROM `shopping_cart` WHERE `user_sid` = ?n ORDER BY `sid` DESC", $userSID);
	}
	
	public static function updateItemBySID($sid, $productInfo)
	{
		return SJB_DB::query("UPDATE `shopping_cart` SET `product_info` = ?s WHERE `sid` = ?n ", serialize($productInfo), $sid);
	}
	
	public static function deleteItemsFromCartByUserSID($userSID)
	{
		return SJB_DB::query("DELETE FROM `shopping_cart` WHERE `user_sid` = ?n", $userSID);
	}

	public static function getProductsInfoFromCartByProductSID($productSID, $currentUserID)
	{
		$serializedProductSIDForShopCart = '"sid";s:'.strlen($productSID).':"'.$productSID.'";';
		return SJB_DB::query("SELECT `sid`,`product_info` FROM `shopping_cart` WHERE `user_sid` = ?n AND `product_info` REGEXP '({$serializedProductSIDForShopCart})' ORDER BY `sid` DESC", $currentUserID);
	}
}
