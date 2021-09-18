 
-- Copyright (C) 2014 Joseph W Becher

-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.

-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.

-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.


-- Require npcBlockerCommands.lua
-- require "npcBlockerCommands";

local _, L = ...;

    -- Create the table to hold the npcs we want to block says for
local npcBlock_Defaults = {
  ["NPCs"] = {},
};

-- create a frame to listen to game events
local mainFrame, mainFrameEvents = CreateFrame("FRAME"), {};

--------------------------------------------------------------------------------
-- Initialize the npcSay table
local function npcBlock_Init()

    -- Populate the npcBlock_Defaults["NPCs"] table

    -- Block says from npcs  
    table.insert(npcBlock_Defaults["NPCs"], "Topper McNabb");
    table.insert(npcBlock_Defaults["NPCs"], "Morris Lawry");
  
    -- Celestial court noodle vendors
    table.insert(npcBlock_Defaults["NPCs"], "Brother Noodle");
    table.insert(npcBlock_Defaults["NPCs"], "Great Chef Woo");
    table.insert(npcBlock_Defaults["NPCs"], "Sapmaster Vu");
    table.insert(npcBlock_Defaults["NPCs"], "Hearthminder Digao");
    table.insert(npcBlock_Defaults["NPCs"], "Master Miantiao");
    table.insert(npcBlock_Defaults["NPCs"], "Noodle-Maker Monmon");
    table.insert(npcBlock_Defaults["NPCs"], "Big Dan Stormstout");
    table.insert(npcBlock_Defaults["NPCs"], "Galu Wellspring");
    table.insert(npcBlock_Defaults["NPCs"], "Grimthorn Redbeard");
    table.insert(npcBlock_Defaults["NPCs"], "Crafter Kwon");
    table.insert(npcBlock_Defaults["NPCs"], "Smiling Jade");
    table.insert(npcBlock_Defaults["NPCs"], "Graceful Swan");
    table.insert(npcBlock_Defaults["NPCs"], "Drix Blackwrench");
    table.insert(npcBlock_Defaults["NPCs"], "Smiling Jade");
    -- Celestial Court Brewmasters
    table.insert(npcBlock_Defaults["NPCs"], "Brewmaster Tzu");
    -- Celestial Court Protectors
    table.insert(npcBlock_Defaults["NPCs"], "Protector Yi");



end

-- this is the chat filter that hides the chat messages we don't want.
function npcBlocker__ChannelMsgFilterNPCSay(self, event, msg, author, ...)
    -- print the lines
    for i,npc in ipairs(npcBlock_Defaults["NPCs"]) do
        if author == npc then 
            return true
        end
    end
    -- Block all yells from players
    if event == "CHAT_MSG_YELL" then return true
    end
end

--------------------------------------------------------------------------------
-- ADDON_LOADED event handler
function mainFrameEvents:ADDON_LOADED(arg1)

    if arg1 == "npcblocker" then
        if (not npcBlock_Options) then
            npcBlock_Options = npcBlock_Defaults["Options"];
            DEFAULT_CHAT_FRAME:AddMessage(L["npcBlocker Options database not found. Generating..."]);
        end

        if next(npcBlock_Defaults["NPCs"]) == nil then
            DEFAULT_CHAT_FRAME:AddMessage(L["npcBlocker NPC database needs to be rebuilt..."]);
            npcBlock_Init();
        end

        if npcBlockerStatus == nil then
            npcBlockerStatus = true;
        end

        if npcBlockerStatus == true then
            addChatFilters();
        end

        -- Our saved variables are ready at this point. If there are none, both variables will set to nil.
        print(L["NPC Blocker Loaded."]);
    end
end

--------------------------------------------------------------------------------
-- Register defigned events
mainFrame:SetScript("OnEvent", function(self, event, ...)
 mainFrameEvents[event](self, ...); -- call one of the functions above
end);
for k, v in pairs(mainFrameEvents) do
 mainFrame:RegisterEvent(k); -- Register all events for which handlers have been defined
end

----------------------------------------------------
-- Remove the chat filters
function removeChatFilters()
    -- add chat filter for npc says
    ChatFrame_RemoveMessageEventFilter("CHAT_MSG_MONSTER_SAY", npcBlocker__ChannelMsgFilterNPCSay);
    -- add chat filter for player yells
    ChatFrame_RemoveMessageEventFilter("CHAT_MSG_YELL", npcBlocker__ChannelMsgFilterNPCSay);
    print(L["NPC Blocker is now off."]);
end

----------------------------------------------------
-- Add the chat filters
function addChatFilters()
    -- add chat filter for npc says
    ChatFrame_AddMessageEventFilter("CHAT_MSG_MONSTER_SAY", npcBlocker__ChannelMsgFilterNPCSay);
    -- add chat filter for player yells
    ChatFrame_AddMessageEventFilter("CHAT_MSG_YELL", npcBlocker__ChannelMsgFilterNPCSay);
    print(L["NPC Blocker is now on."]);
end


--------------------------------------------------------------------------------
-- Create the slash command
SLASH_NPCBLOCKER_TOGGLESTATUS1 = '/npcblock';
SLASH_NPCBLOCKER_DUMPDATABASE1 = '/npcblock_dump';
SLASH_NPCBLOCKER_RELOADDATABASE1 = '/npcblock_reload';

-- Assign slash command to the handler function
SlashCmdList["NPCBLOCKER_TOGGLESTATUS"] = npcBlocker__slashToggleStatus;
SlashCmdList["NPCBLOCKER_DUMPDATABASE"] = npcBlocker__slashDumpDatabase;
SlashCmdList["NPCBLOCKER_RELOADDATABASE"] = npcBlocker__slashReloadDatabase;



