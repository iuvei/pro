package data_merge

import (
	"framework/render"
)

type Finished2 struct {
	Key
	CdnUrl   string //
	UrlLink  string
	PageType int //页面类型 1存款 2取款 3额度转换 4客服
}

func (m *Finished2) GetData(siteId, siteIndexId string) (interface{}, error) {
	m.CdnUrl = render.CdnUrl
	//站点客服链接
	siteinfo, has, err := SiteInfoBean.GetSingleSiteInfo(siteId, siteIndexId)
	if err != nil {
		m.UrlLink = ""
	}
	if has == false {
		m.UrlLink = ""
	} else {
		m.UrlLink = siteinfo.UrlLink
	}
	m.PageType = 1
	return m, nil
}

func (m *Finished2) GetPage() []string {
	return []string{WAP_FINISHED2, WAP_MEM_FOOTER}
}