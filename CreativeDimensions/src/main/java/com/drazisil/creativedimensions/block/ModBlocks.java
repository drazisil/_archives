package com.drazisil.creativedimensions.block;

import com.drazisil.creativedimensions.block.BlockCreativePortal;
import net.minecraft.block.Block;
import net.minecraft.block.material.Material;
import net.minecraftforge.fml.common.registry.GameRegistry;

/**
 * Created by drazisil on 2/10/2017.
 */
public class ModBlocks {

    public static Block blockCreativePortal;

    public static void createBlocks() {
        GameRegistry.register(new BlockCreativePortal(Material.PORTAL));
    }
}