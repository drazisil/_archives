package com.drazisil.creativedimensions.items;

import com.drazisil.creativedimensions.CreativeDimensions;
import com.drazisil.creativedimensions.items.ItemWand;
import net.minecraft.item.Item;
import net.minecraftforge.fml.common.registry.GameRegistry;

/**
 * Created by drazisil on 2/10/2017.
 */
public final class ModItems {

    public static Item itemWand;

    public static void createItems() {
        itemWand = new ItemWand().setRegistryName(CreativeDimensions.MODID, "wand");
        GameRegistry.register(itemWand);
    }
}