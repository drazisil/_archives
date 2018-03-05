package com.drazisil.creativedimensions.world;

import net.minecraft.world.World;
import net.minecraft.world.chunk.IChunkGenerator;
import net.minecraft.world.chunk.IChunkProvider;
import net.minecraftforge.fml.common.IWorldGenerator;

import java.util.Random;

/**
 * Created by drazisil on 2/9/2017.
 */
public class CreativeDimensionsWorldGenerator implements IWorldGenerator {

    public static CreativeDimensionsWorldGenerator instance = new CreativeDimensionsWorldGenerator();

    @Override
    public void generate(Random random, int chunkX, int chunkZ, World world, IChunkGenerator chunkGenerator, IChunkProvider chunkProvider) {

    }
}
