package com.drazisil.creativedimensions.client.renderer;

import com.drazisil.creativedimensions.CreativeDimensions;

import com.drazisil.creativedimensions.items.ModItems;
import net.minecraft.client.Minecraft;
import net.minecraft.client.renderer.block.model.ModelResourceLocation;
import net.minecraft.item.Item;

/**
 * Created by drazisil on 2/10/2017.
 */
public class ItemRenderRegister {

    public static String modid = CreativeDimensions.MODID;

    public static void registerItemRenderer() {
        reg(ModItems.itemWand);
    }

    public static void reg(Item item) {
        System.out.println("ItemWand Name Reg >> " + item.getUnlocalizedName());
        Minecraft.getMinecraft().getRenderItem().getItemModelMesher()
                .register(item, 0, new ModelResourceLocation(modid + ":" + "wand", "inventory"));
    }
}
