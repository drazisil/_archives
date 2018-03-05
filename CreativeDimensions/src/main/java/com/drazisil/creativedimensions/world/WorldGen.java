package com.drazisil.creativedimensions.world;

import com.drazisil.creativedimensions.CreativeDimensions;
import net.minecraftforge.common.MinecraftForge;
import net.minecraftforge.fml.common.registry.GameRegistry;

/**
 * Created by drazisil on 2/9/2017.
 */
public class WorldGen {

    public static void init() {
        GameRegistry.registerWorldGenerator(CreativeDimensionsWorldGenerator.instance, 10);
        MinecraftForge.EVENT_BUS.register(CreativeDimensions.instance);
    }
}