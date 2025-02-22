package com.cmarti21.shoppinglist.database

import androidx.room.TypeConverter
import java.util.*

class Converters {
    @TypeConverter
    fun toUUID(uuid: String?): UUID? {
        return UUID.fromString(uuid)
    }

    @TypeConverter
    fun fromUUID(uuid: UUID?): String? {
        return uuid?.toString()
    }
}