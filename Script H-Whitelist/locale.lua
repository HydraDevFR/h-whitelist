Locales = {}

function _(str, ...)

	if Locales[Config.Locale] ~= nil then

		if Locales[Config.Locale][str] ~= nil then
			return string.format(Locales[Config.Locale][str], ...)
		else
			return 'Traduction [' .. Config.Locale .. '][' .. str .. '] n\'existe pas'
		end

	else
		return 'La config [' .. Config.Locale .. '] n\'existe pas'
	end

end

function _U(str, ...)
	return tostring(_(str, ...):gsub("^%l", string.upper))
end
