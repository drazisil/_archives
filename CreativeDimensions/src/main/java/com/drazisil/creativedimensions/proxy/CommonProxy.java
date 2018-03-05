package com.drazisil.creativedimensions.proxy;

import com.drazisil.creativedimensions.CreativeDimensions;
import com.drazisil.creativedimensions.client.renderer.ItemRenderRegister;
import com.drazisil.creativedimensions.items.ModItems;
import com.drazisil.creativedimensions.world.WorldProviderCreative;
import net.minecraft.world.DimensionType;
import net.minecraftforge.common.DimensionManager;
import net.minecraftforge.fml.common.event.FMLInitializationEvent;
import net.minecraftforge.fml.common.event.FMLPostInitializationEvent;
import net.minecraftforge.fml.common.event.FMLPreInitializationEvent;

import static com.drazisil.creativedimensions.items.ModItems.itemWand;

/**
 * Created by drazisil on 2/9/2017.
 */
public class CommonProxy {

    public void preInit(FMLPreInitializationEvent e) {

        // WorldGen.init();

        ModItems.createItems();

    }

    public void init(FMLInitializationEvent e) {

        ItemRenderRegister.registerItemRenderer();

        System.out.println("ItemWand1 >> " + itemWand.getUnlocalizedName());
        System.out.println("ItemWand2 >> " + itemWand.getRegistryName());

        // Register Dimension
        DimensionType.register("creative", "_creative", CreativeDimensions.dimensionProviderID, WorldProviderCreative.class, false);
        DimensionManager.registerDimension(CreativeDimensions.dimensionID, DimensionType.valueOf("creative"));

    }

    public void postInit(FMLPostInitializationEvent e) {


    }

}
