# Grebles Solutions — Business Plan

> Living document. Update as the business and product evolve.
> Last updated: 2026-06-12

## 1. Executive Summary

Grebles Solutions is an AI-first IT solutions company based in Zimbabwe, serving SMEs and mid-size organisations across Southern Africa (Zimbabwe, South Africa, Botswana, Zambia, Namibia). We deliver process automation, web/application development, systems integration, and AI engineering — with a twist: the company itself is run by one founder plus a fleet of AI agents. Every service we sell, we use ourselves. Customers experience a responsive, 24/7, large-organisation-grade service; the proof of our product is how we operate.

The flagship productized offer is the **"AI Employee"** — a deployed AI agent (WhatsApp chat, voice calls, or email) grounded in a Company Knowledge Base built from the client's own business content, sold with a setup fee plus a monthly retainer. Custom development, integration, and IT governance advisory (COBIT-based) round out the higher-ticket services.

## 2. Vision & Mission

- **Vision:** To be Southern Africa's leading AI-run IT solutions provider — proving that a lean, AI-augmented company can outserve traditional agencies, and giving every African SME access to the same AI workforce.
- **Mission:** Automate the repetitive work of Southern African businesses through AI agents, custom software, and well-governed integrations, so owners can focus on growth.

## 3. The Problem

- **SMEs are drowning in manual work.** Missed calls, slow WhatsApp replies, manual invoicing and quote follow-ups lose them sales daily. WhatsApp is the main sales channel for **78% of Sub-Saharan African SMEs**, but most can't answer it 24/7.
- **No in-house IT capacity.** Most Southern African SMEs cannot evaluate, deploy, or manage AI/IT systems themselves — existing chatbot/automation products are built for big companies with IT departments.
- **Traditional dev agencies are slow and expensive.** Custom software quotes are out of reach for SMEs; off-the-shelf SaaS rarely integrates with local realities (mobile money, ZWG/USD multi-currency, load-shedding-resilient workflows).
- **Governance gap.** As AI adoption accelerates, AI governance and third-party risk are now the **top two concerns (37% each)** of digital trust leaders — yet almost no regional provider offers affordable, framework-based (COBIT) guidance to SMEs and mid-size firms.

## 4. The Solution

An AI-first services company with productized offerings. The Laravel + Vue application in this repository is the operational backbone: public website, client portal, agent provisioning/management, billing, and support — itself largely run by AI agents.

### Service Lines & Products

| # | Product / Service | What it is | Type |
|---|------------------|------------|------|
| 1 | **AI Customer Agent (WhatsApp-first)** | 24/7 chat agent with a Company Knowledge Base built from the client's docs/price lists/FAQs; qualifies leads, answers customers, escalates to a human. WhatsApp, web widget, and Facebook/Instagram channels. | Productized, recurring |
| 2 | **AI Voice Receptionist** | Answers the client's phone line, books appointments, takes messages, speech-to-speech in a natural voice. (US data: saves SMBs $23k–42k/yr; ROI breakeven ~3 months.) | Productized, recurring |
| 3 | **AI Video Agent / Avatar Employee** | A real-time, face-to-face AI agent on video calls: an avatar that talks (speech-to-speech via Gemini Live API), sees shared screens to guide customers through forms/products, and runs sales demos or support sessions 24/7. Built on LiveKit. | Productized, recurring (premium tier) |
| 4 | **Process Automation Packs (n8n-powered)** | Quote follow-ups, invoice generation & payment reminders, document data extraction, CRM updates, email triage. Built on self-hosted n8n (white-labelled per client) — clients get a visual dashboard of their automations. Sold as bundles of 1–2, 3–6, or 6+ workflows. | Project + retainer |
| 5 | **Website Essentials / Website-as-a-Service** | Entry product for small companies: a new website or a refresh of an old one, with an AI agent added to it. Sold as a project + care plan, or as a low-upfront monthly subscription (WaaS). The front door of the funnel. | Productized, recurring |
| 6 | **Web & App Development** | Business websites, e-commerce, customer portals, custom systems — with mobile money and regional payment integration as a signature capability. | Project |
| 7 | **Systems Integration & Architecture** | Connect accounting (Sage/QuickBooks/Xero/Odoo), POS, payment, and AI systems; design integration architecture for growing firms. | Project |
| 8 | **IT & AI Governance Advisory (COBIT)** | Governance health-checks, AI-adoption policy, IT risk & compliance roadmaps for SMEs and mid-size firms — leveraging COBIT Foundation certification. Upsell path into NGOs, banks, and corporates. | Consulting |
| 9 | **"AI-Run Business" Transformation** | The meta-offer: replicate Grebles' own AI-operated model inside a client's business — agents + automations + governance as one engagement. | Flagship engagement |

### What Makes It Different

- **We are the case study.** Sales, support, scheduling, and follow-up at Grebles are agent-operated; prospects experience the product before they buy it. Discovery calls can be taken by a Grebles avatar on a live video call — an unforgettable demo no regional competitor can match.
- **Local-first engineering:** mobile money integration, multi-currency (ZWG/USD/ZAR), WhatsApp-native, low-bandwidth-friendly.
- **Governed AI:** COBIT-based governance wrapper differentiates from "chatbot shops" and unlocks corporate/NGO/regulated clients.

## 5. Target Market

- **Primary (year 1):** Zimbabwean SMEs in service industries that live on WhatsApp and phone calls — medical/dental practices, law firms, real estate agents, schools, hardware suppliers, tour operators, restaurants, salons, logistics.
- **Secondary (year 1–2):** South African and Botswana SMEs (higher willingness to pay, mature AI awareness — strong existing demand for WhatsApp automation) sold remotely; diaspora-owned Zimbabwean businesses.
- **Tertiary (year 2+):** Mid-size firms, NGOs, and financial-sector clients for integration + governance engagements; white-label agent provisioning for other agencies.
- **Market signals:** MEA governance/risk/compliance market growing at ~15% CAGR; voice AI agents at ~35% CAGR globally; SME AI adoption jumped from 39%→55% in one year (US benchmark, trend reaching the region).

## 6. Revenue Model

Hybrid: **setup fee + monthly retainer** (recurring revenue is the goal), plus project fees for dev/integration work. Two price ladders — Zimbabwe-calibrated and regional (SA/Botswana, priced in USD/ZAR at higher points).

| Revenue Stream | Zimbabwe Pricing (USD) | Regional Pricing (USD) | Notes |
| -------------- | ---------------------- | ---------------------- | ----- |
| AI Customer Agent (WhatsApp) | $300–$800 setup + $80–$250/mo | $1,000–$2,500 setup + $250–$600/mo | Tiered by channels & message volume |
| AI Voice Receptionist | $500–$1,200 setup + $150–$400/mo | $1,500–$3,000 setup + $400–$900/mo | Per line + minutes |
| AI Video Agent / Avatar | $1,000–$2,500 setup + $250–$600/mo | $2,500–$6,000 setup + $600–$1,500/mo | Premium "wow" tier; per-minute video caps |
| Automation Pack (1–2 workflows) | $400–$1,200 | $1,000–$3,500 | One-off + optional support retainer |
| Automation System (3–6 workflows) | $1,500–$4,000 | $4,000–$12,000 | Global benchmark range |
| Website Essentials / WaaS | $250–$900 project or $50–$180/mo WaaS | $800–$2,500 project or $120–$500/mo WaaS | 12-mo minimum on WaaS; AI agent add-on |
| Web/App Development | $800–$5,000+ | $3,000–$15,000+ | Mobile money integration premium |
| Integration & Architecture | $1,000–$6,000 | $5,000–$20,000 | Scoped per engagement |
| Governance Advisory (COBIT) | $500–$2,000 per assessment | $2,000–$8,000 | Recurring annual reviews |
| Support/Care Retainer | $50–$150/mo | $200–$500/mo | Hosting, monitoring, updates |

Three deployment models are offered: **Grebles-hosted (managed, default)**, **client self-hosted**, and **on-premises** — pricing multipliers, responsibilities, and full costing rules are in the internal [Service Delivery Playbook](SERVICE_DELIVERY_PLAYBOOK.md).

**Unit economics note:** agent infrastructure (LLM API, telephony, WhatsApp Business API, hosting) should be kept under ~30% of each retainer; meter usage and cap volumes per tier.

## 7. Competition

| Competitor | Strengths | Weaknesses | Our Edge |
| ---------- | --------- | ---------- | -------- |
| SA WhatsApp-bot SaaS (BotBooster, BizAI, Gotbot, etc.) | Polished, self-serve, cheap entry | Generic; no custom dev, no local Zim presence, no voice + governance | Full-service: custom dev + agents + integration under one roof |
| Traditional Zim IT firms (web shops, ERP resellers) | Local trust, established clients | Little/no AI capability; slow; project-only | AI-native, recurring-revenue products, 24/7 service experience |
| Global no-code AI agencies (remote) | Cheap workflows | No local payments/context, timezone, no accountability | On-the-ground knowledge: mobile money, ZWG, local compliance |
| Meta's free Business AI agent | Free, built into WhatsApp | Generic, no Company Knowledge Base on business docs, no integrations or voice | Deep customisation, multi-channel, integrated into client systems |
| Big-4 / large consultancies (governance) | Brand, depth | Priced for corporates only | SME-affordable COBIT-based advisory |

## 8. Marketing & Customer Acquisition

- **Demo-as-marketing:** Grebles' own WhatsApp number and phone line are answered by our agents — every inbound prospect experiences the product immediately. Public demo line featured on the website.
- **Niche landing pages + case studies:** one page per vertical (e.g. "AI receptionist for dental practices in Harare") with before/after metrics from pilot clients.
- **Pilot-first strategy:** 3–5 discounted pilot clients in month 1–3 in exchange for testimonials and measurable case studies (missed-call recovery %, response time, sales captured after hours).
- **Channels:** LinkedIn + WhatsApp status/business broadcasts, Techzim and local business media PR, Zimbabwe/SA business WhatsApp groups, chamber of commerce and SME associations, Google Business Profile.
- **AI-run outbound:** an SDR agent researches local businesses, drafts personalised outreach emails, and books discovery calls into the founder's calendar.
- **Referral programme:** one month free retainer per converted referral.
- **Regional expansion:** sell remotely into SA/Botswana with online onboarding; partner with local resellers (accountants, marketing agencies) on revenue share.

## 9. Operations & Team (the AI-Run Company)

Founder (Gregory) handles: sales closing, solution architecture, engineering, client relationships. Everything else is agent-operated:

| Function | Operated by | Notes |
| -------- | ----------- | ----- |
| Inbound sales & enquiries | WhatsApp + voice agents | 24/7, books meetings, qualifies leads |
| Outbound lead generation | SDR agent | Research + personalised email outreach |
| Customer support (tier 1) | Support agent grounded in the Company Knowledge Base | Escalates to founder |
| Project status updates | Reporting agent | Weekly client emails from the portal |
| Invoicing & payment chasing | Billing automation | Laravel app + payment APIs |
| Monitoring & alerts | Ops automation | Uptime, agent health, usage caps |
| Bookkeeping prep, contracts, proposals | Document agents | Founder reviews before sending |

**Build-once rule:** every internal agent/automation is built to be resellable as a product (multi-tenant from day one in the Laravel app).

## 10. Financial Plan

- **Startup costs (lean):** ~$500–$1,500 — domain/hosting/VPS, WhatsApp Business API access, telephony/voice API credits, LLM API credits, company registration.
- **Monthly running costs:** ~$150–$500 initially (APIs, hosting, tools), scaling with client usage (passed through in retainers).
- **Break-even target:** ~5–8 retainer clients covers all running costs + basic founder income.
- **Revenue goals:**
  - **3 months:** 3–5 pilot clients converted to paying retainers (~$500–$1,500 MRR) + 1–2 dev projects.
  - **6 months:** ~$2,500–$5,000 MRR + steady project pipeline; first SA/regional clients.
  - **12 months:** ~$8,000–$15,000 MRR across 25–50 agent clients + projects + first governance engagements. (Global solo-founder benchmark: $10k–$25k/mo within 6–12 months; regional pricing implies the lower band initially.)

## 11. Milestones & Roadmap

| Milestone | Target Date | Status |
| --------- | ----------- | ------ |
| Business plan completed | 2026-06 | In progress |
| Laravel + Vue platform installed | 2026-06-12 | ✅ Done |
| Company website + AI demo agent live (this app) | 2026-07 | Pending |
| Productized AI Customer Agent v1 (WhatsApp + Company Knowledge Base, multi-tenant) | 2026-07 | Pending |
| 3 pilot clients onboarded | 2026-08 | Pending |
| AI Voice Receptionist v1 (Gemini Live + LiveKit) | 2026-09 | Pending |
| n8n automation platform self-hosted (white-label ready) | 2026-09 | Pending |
| First 2 case studies published | 2026-09 | Pending |
| Client portal + automated billing live | 2026-10 | Pending |
| AI Video Agent / Avatar v1 (video calls + screen share) | 2026-11 | Pending |
| First paying SA/regional client | 2026-11 | Pending |
| Internal AI-run ops complete (SDR, support, billing agents) | 2026-12 | Pending |
| First COBIT governance engagement | 2027-Q1 | Pending |
| $5k MRR | 2027-Q1 | Pending |

## 12. Risks & Assumptions

| Risk / Assumption | Mitigation / Test |
| ----------------- | ----------------- |
| Zimbabwe SME willingness/ability to pay USD retainers | Pilot pricing tests month 1–3; lead with ROI (missed-call recovery); target USD-earning sectors first |
| WhatsApp Business API policy or pricing changes; Meta's free AI agent commoditises basic bots | Multi-channel (voice, web, email); compete on Company Knowledge Base depth + integrations, not basic chat |
| LLM/API costs erode retainer margins | Usage caps per tier, model routing (cheap models for simple turns), pass-through pricing clauses |
| Power/connectivity instability in Zimbabwe | Cloud-hosted infrastructure abroad; offline-tolerant workflows; Starlink/backup connectivity |
| Currency volatility (ZWG) | Price in USD; regional clients paid in USD/ZAR |
| Solo-founder bottleneck (sales + delivery) | Productize aggressively; templates per vertical; agents handle tier-1 everything |
| Payment collection friction | Upfront setup fees, mobile-money + card + Wise/Payoneer options, suspend-on-nonpayment automation |
| Regulatory: data protection (Zimbabwe Cyber & Data Protection Act, POPIA in SA) | Built-in consent flows + data policies; COBIT skill set makes compliance a selling point, not a cost |
| Vendor lock-in (Gemini Live API pricing/policy changes) | LiveKit is provider-agnostic — agents can swap to OpenAI Realtime or other speech-to-speech models; keep the realtime layer abstracted |
| Video/avatar bandwidth requirements vs. regional connectivity | Always offer voice-only and chat fallbacks; adaptive bitrate via LiveKit; position video tier for SA/urban clients first |

---

## Appendix A — Technology Stack

**Core platform (this repository)**
- **Laravel 13 + Vue 3 (Inertia) + Tailwind + MySQL** — company website, client portal, multi-tenant agent management, billing, usage metering.

**AI & realtime layer**
- **Gemini Live API** — real-time speech-to-speech conversations, live video understanding, and screen-share comprehension (the agent can watch a customer's shared screen and guide them).
- **LiveKit** — WebRTC infrastructure for voice/video calls and the LiveKit Agents framework; connects phone lines (SIP) and browser calls to AI agents. Provider-agnostic: keeps us free to swap the underlying speech model (Gemini Live, OpenAI Realtime, etc.).
- **Avatars** — talking-head avatar layer (e.g. Simli, HeyGen/Tavus-class APIs, or open-source alternatives) rendered into LiveKit video tracks for face-to-face AI agents.
- **Company Knowledge Base** — embeddings + vector store over each client's documents, price lists, policies; the knowledge backbone of every agent.
- **Agent tools** — web search, email send/receive, calendar booking, CRM/database lookups, payment status checks.

**Automation layer**
- **n8n (self-hosted)** — visual workflow automation for client processes; white-labelled per client with their own dashboard. Self-hosting keeps per-client costs near zero and data in our control.
- Complementary: Laravel queues/jobs for product-internal automation; webhooks as the integration lingua franca between the platform, n8n, and client systems.

**Channels & integrations**
- WhatsApp Business API, web chat widget, email, SIP/telephony (via LiveKit SIP or providers like Twilio / Africa's Talking), Facebook/Instagram messaging.
- Payments: mobile money (Zimbabwe), Paystack/PayFast/Yoco (SA), Stripe/Wise for international.

**Principle:** prefer self-hostable, provider-agnostic components (LiveKit, n8n, open knowledge-base stack) so margins stay high and no single vendor can break the business.

## Appendix B — Research Sources (June 2026)

- [SAP Africa: Essential Tech Trends for African SMEs](https://news.sap.com/africa/2026/03/the-essential-tech-trends-for-african-smes/) — AI embedding into finance/HR/customer ops workflows
- [Innovation Village: WhatsApp AI Business Agent for African SMEs](https://innovation-village.com/whatsapp-now-has-an-ai-business-agent-here-is-what-african-smes-need-to-know/) — 78% of Sub-Saharan SMEs sell via WhatsApp; 98% open rates
- [BizAI: WhatsApp Business Automation South Africa](https://www.bizai.co.za/blog/whatsapp-business-automation-south-africa) — SA SME chatbot market and gaps
- [Resonate AI: AI Receptionist Statistics](https://www.resonateapp.com/resources/ai-receptionists-statistics) and [NextPhone: AI Receptionist Guide](https://www.getnextphone.com/blog/ai-receptionist) — voice agent ROI ($23k–42k/yr savings, 3.2-month breakeven)
- [AInora: Voice AI Statistics 2026](https://ainora.lt/blog/voice-ai-statistics-market-data-2026) — voice AI ~35% CAGR
- [Arsum: AI Automation Agency Pricing 2026](https://arsum.com/blog/posts/ai-automation-agency-pricing/) and [Monetizebot: Agency Pricing](https://monetizebot.ai/blogs/ai-automation-agency-pricing-2026) — setup + retainer benchmarks, solo-founder revenue benchmarks
- [NewsDay Zimbabwe: EcoCash Super App review](https://www.newsday.co.zw/theindependent/article/200054648/ecocash-super-app-review-a-blueprint-for-africas-future-digital-ecosystems) — Zimbabwe mobile money ecosystem
- [ISACA: IT Governance Questions for 2026](https://www.isaca.org/resources/news-and-trends/isaca-now-blog/2026/five-questions-it-governance-professionals-will-need-to-answer-in-2026) — AI governance demand; MEA GRC market ~15% CAGR
